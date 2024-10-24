<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderProduct extends Model
{
    use HasFactory;
    public function order(){
        return $this->belongsTo(order::class,'order_id');
    }

    public function product(){
        return $this->belongsTo(product::class, 'product_id');
    }

}
