<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant_order_detail extends Model
{
    use HasFactory;

    protected $with = ['waiter','item','freemenu'];

    public function waiter()
    {
        return $this->belongsTo(Employee::class,'waiter_id');
    }
    public function item()
    {
        return $this->belongsTo(ItemEntry::class,'item_id');
    }
    public function freemenu()
    {
        return $this->belongsTo(SideMenu::class,'item_id','main_id');
    }
}
