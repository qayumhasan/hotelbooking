<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHead extends Model
{
    use HasFactory;

   
    public function items()
    {
        return $this->hasMany(OrderHeadDetails::class,'invoice_no','invoice_no');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Admin','id','entry_by');
    }

    
}
