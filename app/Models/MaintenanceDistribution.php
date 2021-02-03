<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceDistribution extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function issuedby()
    {
        return $this->hasOne('App\Models\Admin','id','issued_by');
    }

    public function items()
    {
        return $this->hasOne('App\Models\ItemEntry','id','item_id');
    }
    public function department()
    {
        return $this->hasOne('App\Models\Department','id','department_id');
    }

    public function unit()
    {
        return $this->hasOne('App\Models\UnitMaster','id','unit_id');
    }
}
