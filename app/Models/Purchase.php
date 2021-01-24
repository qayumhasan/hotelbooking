<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function newstockcenter()
    {
        return $this->belongsTo('App\Models\StockCenter', 'stock_center', 'id');
    }
    public function purchaseheads()
    {
        return $this->hasMany(App\Models\PurchaseHead::class);
    }


}
