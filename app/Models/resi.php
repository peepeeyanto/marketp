<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resi extends Model
{
    use HasFactory;

    public function order_products(){
        return $this->belongsTo(orderProduct::class);
    }
}
