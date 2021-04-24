<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransectionReport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vGuestPaymentReport';



    /**
     * Get the user that owns the phone.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class,'entry_by','id');
    }

     /**
     * Get the taxs 
     */
    public function taxs()
    {
        return $this->hasMany(CheckOut_Tax_Details::class,'booking_no','bookingNo');
    }



}
