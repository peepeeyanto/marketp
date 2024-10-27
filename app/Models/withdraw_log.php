<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdraw_log extends Model
{
    use HasFactory;

    public function beneficiaries() {
        return $this->belongsTo(beneficiaries::class, 'from_acc_no');
    }
    public function vendor() {
        return $this->belongsTo(vendor::class,'vendor_id');
    }
}
