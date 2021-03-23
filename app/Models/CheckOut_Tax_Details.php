<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut_Tax_Details extends Model
{
    use HasFactory;


    public function gettaxDescriptionAttribute()
    {
        if($this->calculation_on == 1){
            return "Room Amount";
        }elseif($this->calculation_on == 2){
            return "Food Amount";
        }elseif($this->calculation_on == 3){
            return "Room Discount";
        }elseif($this->calculation_on == 4){
            return "Net Amount";
        }elseif($this->calculation_on == 5){
            return "Gross Amount";
        }
    }

    public function getbaseonamountAttribute()
    {
        if($this->base_on == 'percentage'){
            return $this->rate .'%';
        }elseif($this->base_on == 'amount'){
            return '$'. $this->rate;
        }
    }
}
