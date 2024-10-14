FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
git \
curl \
libpng-dev \
libonig-dev \
libxml2-dev \
zip \
unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql mbstring

WORKDIR /app
COPY composer.json .
RUN composer install --no-scripts

COPY . .
RUN php artisan key:generate
RUN php artisan config:cache

CMD php artisan serve --host=0.0.0.0 --port 80
EXPOSE 80
