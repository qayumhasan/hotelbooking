<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function guestinfo()
    {
        return $this->belongsTo(Checkin::class,'booking_no','booking_no');
    }

    
    public function cashier()
    {
        return $this->hasOne('App\Models\Admin','id','entry_by');
    }

    public function getvouchertypeAttribute($value)
    {
        if($this->type == 1){
            return "Received";
        }elseif($this->type == 0){
            return "Refund";
        }
    }


    public function getpaymentModeAttribute($value)
    {
        if($this->type == 1){
            return $this->debit;
        }elseif($this->type == 0){
            return $this->credit;
        }
    }

    public function getcreditAmountAttribute($value)
    {
        if($this->type == 1){
            return $this->amount;
        }elseif($this->type == 0){
            return 0;
        }
    }

    public function getdebitAmountAttribute($value)
    {
        if($this->type == 1){
            return 0;
        }elseif($this->type == 0){
            return $this->amount;
        }
    }

    protected $casts = [
        'date' => 'datetime:d/m/Y',
    ];


}
