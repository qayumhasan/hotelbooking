<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    public function getGuestNameAttribute()
    {

        return $this->attributes['title'] . " " . $this->attributes['guest_name'];
    }

    public function user()
    {
        return $this->hasOne('App\Models\Admin','id','checking_by');
    }

    public function roomtype()
    {
        return $this->hasOne('App\Models\RoomType','id','room_type');
    }

     /**
     * Get the user that owns the phone.
     */
    public function checkin()
    {
        return $this->hasMany(CheckinService::class,'booking_no','booking_no');
    }

     /**
     * Get the user that owns the phone.
     */
    public function foodandbeverage()
    {
        return $this->hasMany(KitchenOrderDetails::class,'booking_no','booking_no');
    }


     /**
     * Get the user that owns the phone.
     */
    public function restaurant()
    {
        return $this->hasMany(Restaurant_order_detail::class,'room_booking_no','booking_no');
    }

     /**
     * Get the user that owns the phone.
     */
    public function vouchers()
    {
        return $this->hasMany(Voucher::class,'booking_no','booking_no');
    }
   

}
