<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    
    use HasFactory;
    protected $fillable = ['room_status'];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
    }
    public function roomtype()
    {
        return $this->belongsTo('App\Models\RoomType', 'room_type', 'id');
    }
    public function flortype()
    {
        return $this->belongsTo('App\Models\Floor', 'floor', 'id');
    }

    public function checkin()
    {
        return $this->hasOne('App\Models\Checkin','room_id','id')->where('is_occupy',1);
    }
    public function housekeeping()
    {
        return $this->hasOne('App\Models\HouseKeeping','room_id','id')->where('is_active',1);
    }

    public function housekeepingreport()
    {
        return $this->hasOne('App\Models\HouseKeeping','room_id','id')->latest();
    }

    public function updatedby()
    {
        return $this->hasOne('App\Models\Admin','id','keeping_assign_name');
    }
    public function guestentry()
    {
        return $this->hasOne('App\Models\HouseKeepingGuestEntry','room_id','id');
    }

    public function guestentrycrosscheck()
    {
        return $this->hasOne('App\Models\HouseKeepingGuestEntry','room_id','id')->where('is_active',1);
    }

    public function checkindata()
    {
        return $this->hasMany('App\Models\Checkin','room_id','id');
    }

    public function getNumberOfBookingAttribute()
    {
        return $this->checkindata->count();
        
    }

    public function getNumberOfNightAttribute()
    {
        return $this->checkindata->sum('additional_room_day');
        
    }

    public function getnumberofguestAttribute()
    {
        return $this->checkindata->sum('number_of_person');
    }

    public function gettotalrevenuesAttribute()
    {
        $totalrevenus = 0;
        foreach ($this->checkindata as $item) {
            $totalrevenus = $totalrevenus +$item->checkout['gross_amount'];
        }
        return $totalrevenus;
    }

  


  

   
}
