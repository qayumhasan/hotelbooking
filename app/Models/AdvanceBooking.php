<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceBooking extends Model
{
    use HasFactory;

     /**
     * Get the room associated with the advance booking.
     */
    public function room()
    {
        return $this->hasOne('App\Models\Room','id','room_id');
    }
    public function guest()
    {
        return $this->hasOne('App\Models\Guest','id','guest_id');
    }

    public function bookedby()
    {
        return $this->hasOne('App\Models\Admin','id','booked_by');
    }

    public function roomtype()
    {
        return $this->hasOne('App\Models\RoomType','id','room_type');
    }
}
