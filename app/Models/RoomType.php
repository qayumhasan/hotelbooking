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
}
