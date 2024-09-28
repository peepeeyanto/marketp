<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href={{asset("backend/assets/modules/bootstrap/css/bootstrap.min.css")}}>
        <link rel="stylesheet" href="{{asset('frontend/css/Simple-Bootstrap-Chat.css')}}">
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
        <script src={{asset("backend/assets/modules/jquery.min.js")}}></script>
        <script src={{asset("backend/assets/modules/bootstrap/js/bootstrap.min.js")}}></script>
    </body>
</html>
