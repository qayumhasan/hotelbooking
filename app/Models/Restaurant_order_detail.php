<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant_order_detail extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['waiter','item','freemenu','complementitem','orderHead'];

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
    public function complementitem()
    {
        return $this->belongsTo(ItemEntry::class,'complement');
    }

    public function orderHead()
    {
        return $this->hasOne(Restaurant_Order_head::class,'invoice_no','invoice_id');
    }
    public function tableName()
    {
        return $this->belongsTo(RestaurantTable::class,'table_no');
    }

    public function cashier()
    {
        return $this->belongsTo(Admin::class,'entry_by');
    }



    

    
}
