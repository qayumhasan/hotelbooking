<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant_Tax_head extends Model
{
    use HasFactory;

     /**
     * Get the phone associated with the user.
     */
    public function taxdetails()
    {
        return $this->hasOne(TaxSetting::class,'id','tax_id');
    }

    
    public function getCalculationAttribute()
    {
         if($this->attributes['calculation_id'] == 1){
            return "Gross Amount";
         }elseif($this->attributes['calculation_id'] == 2){
             return "Food Amount";
         }elseif($this->attributes['calculation_id'] == 3){
            return "Discount Amount";
         }elseif($this->attributes['calculation_id'] == 4){
             return "Net Amount";
         }
            
        
    }

    public function getTaxRateAttribute()
    {
        if($this->base_on == 'percentage'){
            return $this->rate.'%';
        }else{
            return '$'.$this->rate;
        }
    }
}
