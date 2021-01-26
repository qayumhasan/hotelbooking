<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseKeepingGuestEntry extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function varifiedby()
    {
        return $this->hasOne('App\Models\Admin','id','varified_by');
    }

    public function room()
    {
        return $this->hasOne('App\Models\Room','id','room_id');
    }
   
}
