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
}
