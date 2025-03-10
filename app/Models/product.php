<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public function productImageGallery(){
        return $this->hasMany(productImageGallery::class);
    }

    public function variants(){
        return $this->hasMany(productVariant::class);
    }
    public function vendor(){
        return $this->belongsTo(vendor::class);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function reviews(){
        return $this->hasMany(productReview::class,'product_id');
    }
}
