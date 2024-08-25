<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function transaction(){
        return $this->hasOne(transaction::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
}
