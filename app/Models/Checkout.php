<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\Admin','id','entry_by');
    }

    public function room()
    {
        return $this->hasOne('App\Models\Room','id','prime_room');
    }

    
    /**
     * Get the phone associated with the user.
     */
    public function checkin()
    {
        return $this->hasOne('App\Models\Checkin','booking_no','booking_no');
    }

    public function checkindata()
    {
        return $this->hasMany('App\Models\Checkin','booking_no','booking_no');
    }

    public function voucherData()
    {
        return $this->hasMany('App\Models\AccountTransectionHead','booking_no','reference')->where('is_active',1)->where('is_deleted',0);
    }

    public function taxdetails()
    {
        return $this->hasMany('App\Models\CheckOut_Tax_Details','booking_no','booking_no');
    }
}
