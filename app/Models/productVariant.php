<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productVariant extends Model
{
    use HasFactory;
    public function productVariantItems(){
        return $this->hasMany(productVariantItem::class);
    }

    public function product(){
        return $this->belongsTo(product::class);
    }
}
