<?php
namespace App\Traits;

use App\Models\Checkout;
use App\Models\CheckOut_Tax_Details;
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
           
                $this->tax = ($amount * $this->rate) /100;
           
            // calculation on room Discount

            }elseif($this->calculation_on == 3){

                $amount =$this->getCheckoutDetails()->discount_amount;
                if($amount){
                    $this->tax = ($amount * $this->rate) /100;
                }

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

    public function storeTax(Request $request)
    {
        $taxsetting = TaxSetting::findOrFail($request->tax_details);

        $checkunique = CheckOut_Tax_Details::where('tax_description_id',$request->tax_details)->where('calculation_on',$request->calculation_on)->first();
        if(!$checkunique){
            $tax = new CheckOut_Tax_Details();
            $tax->booking_no = $request->booking_no;
            $tax->invoice_no = $request->invoice_no;
            $tax->tax_description_id = $request->tax_details;
            $tax->tax_description_name = $taxsetting->tax_description;
            $tax->calculation_on = $request->calculation_on;
            $tax->base_on = $request->base_on;
            $tax->rate = $request->rate;
            $tax->amount = $request->amount;
            $tax->effect = $taxsetting->effect;
            $tax->save();
        }else{
            $checkunique = new CheckOut_Tax_Details();
            $checkunique->booking_no = $request->booking_no;
            $checkunique->invoice_no = $request->invoice_no;
            $checkunique->tax_description_id = $request->tax_details;
            $checkunique->tax_description_name = $taxsetting->tax_description;
            $checkunique->calculation_on = $request->calculation_on;
            $checkunique->base_on = $request->base_on;
            $checkunique->rate = $request->rate;
            $checkunique->amount = $request->amount;
            $checkunique->effect = $taxsetting->effect;
            $checkunique->save();
        }

      
        $checkout = Checkout::where('booking_no',$request->booking_no)->where('invoice_no',$request->invoice_no)->first();

        if($taxsetting->effect == 'Deduct'){

            if($request->calculation_on == 1){

                // $checkout->decrement('room_amount',$request->amount);  
                $checkout->decrement('gross_amount',$request->amount);  
                $checkout->decrement('outstanding_amount',$request->amount);  
                $checkout->increment('discount_amount',$request->amount);  


            }elseif($request->calculation_on == 2){

                // $checkout->decrement('fb_amount',$request->amount);  
                $checkout->decrement('gross_amount',$request->amount);  
                $checkout->decrement('outstanding_amount',$request->amount);  
                $checkout->increment('discount_amount',$request->amount);  

            }elseif($request->calculation_on == 3){

                $checkout->decrement('gross_amount',$request->amount); 
                $checkout->decrement('outstanding_amount',$request->amount); 
                $checkout->increment('discount_amount',$request->amount);   

            }elseif($request->calculation_on == 4){

                // $checkout->decrement('net_amount',$request->amount);  
                $checkout->decrement('gross_amount',$request->amount);  
                $checkout->decrement('outstanding_amount',$request->amount);  
                $checkout->increment('discount_amount',$request->amount);  

            }elseif($request->calculation_on == 5){

                $checkout->decrement('gross_amount',$request->amount); 
                $checkout->decrement('outstanding_amount',$request->amount); 
                $checkout->increment('discount_amount',$request->amount);   
            }


        } elseif($taxsetting->effect == 'Add'){

            if($request->calculation_on == 1){

                // $checkout->increment('room_amount',$request->amount);  
                $checkout->increment('gross_amount',$request->amount);  
                $checkout->increment('outstanding_amount',$request->amount);  

            }elseif($request->calculation_on == 2){

                // $checkout->increment('fb_amount',$request->amount);  
                $checkout->increment('gross_amount',$request->amount);  
                $checkout->increment('outstanding_amount',$request->amount);  

            }elseif($request->calculation_on == 3){

                $checkout->decrement('discount_amount',$request->amount);  
                $checkout->increment('gross_amount',$request->amount);  
                $checkout->increment('outstanding_amount',$request->amount);  

            }elseif($request->calculation_on == 4){

                // $checkout->increment('net_amount',$request->amount);  
                $checkout->increment('gross_amount',$request->amount);  
                $checkout->increment('outstanding_amount',$request->amount);  

            }elseif($request->calculation_on == 5){

                $checkout->increment('gross_amount',$request->amount);  
                $checkout->increment('outstanding_amount',$request->amount);  
            }
        }
    }


    
}
