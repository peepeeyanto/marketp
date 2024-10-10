<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beneficiaries extends Model
{
    use HasFactory;

    public function vendor(){
        return $this->belongsTo(vendor::class);
    }

    public function withdraw_log(){
        return $this->hasMany(withdraw_log::class, 'beneficiary_id');
    }
}
