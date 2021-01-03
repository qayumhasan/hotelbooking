<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    
    use HasFactory;

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
  

   
}
