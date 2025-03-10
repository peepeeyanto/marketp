<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function transaction(){
        return $this->belongsTo(transaction::class);
    }

    public function resi(){
        return $this->hasOne(resi::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function vendor(){
        return $this->belongsTo(vendor::class);
    }

    public function orderProduct(){
        return $this->hasMany(orderProduct::class);
    }
}
