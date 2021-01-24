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
        return $this->hasOne('App\Models\Checkin','room_id','id');
    }
    public function housekeeping()
    {
        return $this->hasOne('App\Models\HouseKeeping','room_id','id');
    }

    public function updatedby()
    {
        return $this->hasOne('App\Models\Admin','id','keeping_assign_name');
    }


  

   
}
