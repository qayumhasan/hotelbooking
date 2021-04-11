<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    public function rooms()
    {
        return $this->hasMany(Room::class,'room_type','id')->where('is_active',1)->where('is_deleted',0);
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function checkin()
    {
        return $this->hasMany('App\Models\Checkin','room_type','id');
    }

    public function getNumberOfBookingAttribute()
    {
        return $this->checkin->count();
        
    }

    public function getNumberOfNightAttribute()
    {
        return $this->checkin->sum('additional_room_day');
        
    }

    public function getnumberofguestAttribute()
    {
        return $this->checkin->sum('number_of_person');
    }

    public function gettotalrevenuesAttribute()
    {
        $totalrevenus = 0;
        if(count($this->checkin) > 0){
            foreach ($this->checkin as $item) {
                $totalrevenus = $totalrevenus +$item->checkout['gross_amount'];
            }
        }
      
        return $totalrevenus;
    }
}
