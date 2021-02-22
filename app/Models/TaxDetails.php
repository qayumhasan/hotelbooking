<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxDetails extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tax_details_tbl';

       /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getCalculateOnAttribute($value)
    {
        return [
            '1'=>'Gross Amount',
            '2'=>'Food Amount',
            '3'=>'Discount Amount',
            '4'=>'Net Amount',
        ];
    }


    
       /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getEffectOnAttribute($value)
    {
        return [
            '0'=>'Deducted',
            '1'=>'Added'
        ];
    }


}
