<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeadDetails extends Model
{
    use HasFactory;

    public function unitname()
    {
        return $this->hasOne('App\Models\UnitMaster','id','unit');
    }
}
