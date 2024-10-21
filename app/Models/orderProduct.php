<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderProduct extends Model
{
    use HasFactory;

    public function vendor(){
        return $this->belongsTo(vendor::class);
    }

    public function order(){
        return $this->belongsTo(order::class,'order_id');
    }

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function product(){
        return $this->hasMany(product::class);
    }
}
