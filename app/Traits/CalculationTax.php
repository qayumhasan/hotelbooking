<?php
namespace App\Traits;

use App\Models\Checkout;
use App\Models\TaxSetting;
use Illuminate\Http\Request;

class CalculationTax{

    public $tax_details;
    public $calculation_on;
    public $base_on;
    public $rate;
    public $checkout_id;
    public $amount;

    public $tax;



    public function __construct($base_on,$calculation_on,$rate,$tax_details,$checkout_id,$amount = 0)
    {
        $this->tax_details=$tax_details;
        $this->calculation_on=$calculation_on;
        $this->base_on=$base_on;
        $this->rate=$rate;
        $this->checkout_id=$checkout_id;
        $this->amount = $amount;
        
    }


    
    public function getTaxDescripton()
    {
       return TaxSetting::findOrFail($this->tax_details);
    }

    public function getCheckoutDetails()
    {
       return Checkout::findOrFail($this->checkout_id);
    }

    public function calCulateTaxAmount()
    {
        if($this->base_on == 'amount'){
            $this->tax =$this->rate;

        }elseif($this->base_on == 'percentage'){

            // calculation on room amount

            if($this->calculation_on == 1){
                $amount =$this->getCheckoutDetails()->room_amount;

                if($amount){
                    $this->tax = ($amount * $this->rate) /100;
                }

            // calculation on food amount

            }elseif($this->calculation_on == 2){
                $fb_amount = $this->getCheckoutDetails()->fb_amount;
                $restaurant_amount = $this->getCheckoutDetails()->restaurant_amount;
                $amount = $fb_amount + $restaurant_amount;
                if($amount){
                    $this->tax = ($amount * $this->rate) /100;
                }
            // calculation on room Discount

            }elseif($this->calculation_on == 3){

            // calculation on net amount

            }elseif($this->calculation_on == 4){

                $amount =$this->getCheckoutDetails()->net_amount;

                if($amount){
                    $this->tax = ($amount * $this->rate) /100;
                }

            // calculation on gross amount

            }elseif($this->calculation_on == 5){

                $amount =$this->getCheckoutDetails()->gross_amount;
                if($amount){
                    $this->tax = ($amount * $this->rate) /100;
                }

            }

        }
        return $this;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function grossAmount()
    {
        return $this->amount;
    }
}
