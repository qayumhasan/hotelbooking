<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant_Order_head extends Model
{
    use HasFactory;
    public function orderDetail()
    {
        return $this->belongsTo(Restaurant_order_detail::class, 'invoice_no', 'invoice_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(Restaurant_order_detail::class, 'invoice_id', 'invoice_no');
        
    }

    public function taxheads()
    {
        return $this->hasMany(Restaurant_Tax_head::class, 'invoice_id', 'invoice_no');
        
    }

    public function checkin()
    {
        return $this->belongsTo(Checkin::class,'room_no','room_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
    ];
}
