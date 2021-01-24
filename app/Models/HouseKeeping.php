<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseKeeping extends Model
{
    use HasFactory;
    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id', 'id');
    }

    public function updatedby()
    {
        return $this->hasOne('App\Models\Admin','id','keeping_assign_name');
    }

}
