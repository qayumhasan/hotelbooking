<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    // public function getGuestNameAttribute()
    // {

    //     return $this->attributes['title'] . " " . $this->attributes['guest_name'];
    // }

    public function user()
    {
        return $this->hasOne('App\Models\Admin', 'id', 'checking_by');
    }

    public function roomtype()
    {
        return $this->hasOne('App\Models\RoomType', 'id', 'room_type');
    }

    public function guest()
    {
        return $this->hasOne('App\Models\Guest', 'id', 'guest_id');
    }

    /**
     * Get the user that owns the phone.
     */
    public function checkin()
    {
        return $this->hasMany(CheckinService::class, 'booking_no', 'booking_no');
    }

    /**
     * Get the user that owns the phone.
     */
    public function foodandbeverage()
    {
        return $this->hasMany(KitchenOrderDetails::class, 'booking_no', 'booking_no');
    }


    /**
     * Get the user that owns the phone.
     */
    public function restaurant()
    {
        return $this->hasMany(Restaurant_order_detail::class, 'room_booking_no', 'booking_no');
    }

    /**
     * Get the user that owns the phone.
     */
    public function vouchers()
    {
        return $this->hasMany(AccountTransectionHead::class, 'reference','booking_no')->where('is_active',1)->where('is_deleted',0);
    }


    public function checkout()
    {
        return $this->hasOne('App\Models\Checkout', 'booking_no', 'booking_no');
    }


    public function getcashamountAttribute()
    {
        $amount =$this->vouchers->map(function($item){
            if($item->debit == 'cash'){
                return $item->amount;
            }
        })->toArray();

        return array_sum($amount);
    }

    public function getgenderdataAttribute()
    {
        
        if($this->gender == 1){
            return "Male";
        }elseif($this->gender == 2){
            return "Female";
        }
    }

    public function getbankamountAttribute()
    {
        $amount =$this->vouchers->map(function($item){
            if($item->debit == 'bank'){
                return $item->amount;
            }
        })->toArray();

        return array_sum($amount);
    }


    public function getcheckinstatusAttribute()
    {
        if($this->is_occupy == 0){
            return "Checkout";
        }elseif($this->is_occupy == 1){
            return "Occupied";
        }
    }
}
