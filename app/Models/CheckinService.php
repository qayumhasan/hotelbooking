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

    public function itementry()
    {
        return $this->hasOne('App\Models\ItemEntry','id','services');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Admin','id','entry_by');
    }
}
