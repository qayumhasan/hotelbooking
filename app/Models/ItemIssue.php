<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemIssue extends Model
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
    public function room()
    {
        return $this->hasOne('App\Models\Room','id','room_id');
    }
}
