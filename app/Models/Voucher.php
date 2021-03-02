<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function guestinfo()
    {
        return $this->belongsTo(Checkin::class,'booking_no','booking_no');
    }
}
