<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEntry extends Model
{
    use HasFactory;

     /**
     * Get the user that owns the phone.
     */
    public function category()
    {
        return $this->belongsTo(MenuCategory::class,'category_name','id');
    }
     /**
     * Get the user that owns the phone.
     */
    public function unit()
    {
        return $this->belongsTo(UnitMaster::class,'unit_name','id');
    }
}
