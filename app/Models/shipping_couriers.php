<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping_couriers extends Model
{
    use HasFactory;

    public function vendor(){
        return $this->belongsTo(vendor::class,'vendor_id');
    }
}
