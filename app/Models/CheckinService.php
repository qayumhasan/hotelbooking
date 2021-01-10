<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckinService extends Model
{
    use HasFactory;

    public function checkin()
    {
        return $this->hasOne('App\Models\Checkin','id','checkin_id');
    }
}
