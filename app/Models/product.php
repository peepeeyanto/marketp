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
}
