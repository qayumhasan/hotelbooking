<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\Admin','id','entry_by');
    }

    
    /**
     * Get the phone associated with the user.
     */
    public function checkin()
    {
        return $this->hasOne('App\Models\Checkin','booking_no','booking_no');
    }
}
