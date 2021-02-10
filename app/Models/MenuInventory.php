<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuInventory extends Model
{
    use HasFactory;
      /**
     * Get the user that owns the phone.
     */
    public function fgoods_item()
    {
        return $this->belongsTo(MenuCategory::class,'fgoods');
    }
      /**
     * Get the user that owns the phone.
     */
    public function item()
    {
        return $this->belongsTo(ItemEntry::class,'raw_material');
    }

    public function unit_item()
    {
        return $this->belongsTo(UnitMaster::class,'unit');
    }
}
