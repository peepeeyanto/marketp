<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productVariantItem extends Model
{
    use HasFactory;


    public function productVariant()
    {
        return $this->belongsTo(productVariant::class);
    }
}
