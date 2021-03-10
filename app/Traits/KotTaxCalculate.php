<?php

namespace App\Traits;

use App\Models\Restaurant_Order_head;
use App\Models\Restaurant_Tax_head;
use App\Models\TaxSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KotTaxCalculate
{

    private $totalamount;
    private  $taxID;
    private  $calculationon;
    private  $rate;
    private  $baseon;
    private $invoice_no;

    public function __construct(Request $request)
    {
        $this->taxID = $request->tax_discription;
        $this->calculationon = $request->calculation_on;
        $this->rate = $request->rate;
        $this->baseon = $request->base_on;
        $this->invoice_no = $request->invoice_no;
        $this->totalamount = $request->amount;
    }

    public function getKot()
    {
        return Restaurant_Order_head::where('invoice_no', $this->invoice_no)->first();
        
    }

    public function amount()
    {
        if ($this->baseon == 'amount') {
            
            return $this->rate;

        } elseif ($this->baseon == 'percentage') {

            

            // gross amount

            if ($this->calculationon == 1) {

                $amount = $this->getKot()->gross_amount;
                if($amount){
                    $rate = $this->rate / 100;
                    return $amount * $rate;
                }

            }elseif($this->calculationon == 2){
                $amount = $this->getKot()->food_amount;
                if($amount){
                    $rate = $this->rate / 100;
                    return $amount * $rate;
                }

            }elseif($this->calculationon == 3){

                $amount = $this->getKot()->discount_amount;
                if($amount){
                    $rate = $this->rate / 100;
                    return $amount * $rate;
                }
            }elseif($this->calculationon == 4){

                $amount = $this->getKot()->total_amount;
                if($amount){
                    $rate = $this->rate / 100;
                    return $amount * $rate;
                }
            }
        }
        return $this;
    }


    // add to git area start
    
    public function taxEffect()
    {
        return TaxSetting::findOrFail($this->taxID)->effect;
    }

    public function Tax()
    {
        $this->storeTax();

        if($this->taxEffect() == 'Deduct'){
            return $this->deductTax();
        }elseif($this->taxEffect() == 'Add'){
            return $this->addTax();
        }
    }


    public function deductTax()
    {
   
        if ($this->calculationon == 1) {

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->decrement('gross_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('discount_amount',$this->totalamount);

        }elseif($this->calculationon == 2){

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->decrement('gross_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->decrement('food_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('discount_amount',$this->totalamount);
          

        }elseif($this->calculationon == 3){

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->decrement('gross_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('discount_amount',$this->totalamount);
            
        }elseif($this->calculationon == 4){

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->decrement('gross_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->decrement('total_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('discount_amount',$this->totalamount);
        }

    }

    public function addTax()
    {
        if ($this->calculationon == 1) {

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('gross_amount',$this->totalamount);

        }elseif($this->calculationon == 2){

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('gross_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('food_amount',$this->totalamount);
          

        }elseif($this->calculationon == 3){

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('gross_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->decrement('discount_amount',$this->totalamount);
            
        }elseif($this->calculationon == 4){

            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('gross_amount',$this->totalamount);
            Restaurant_Order_head::where('invoice_no',$this->invoice_no)->increment('total_amount',$this->totalamount);
        }
        
    }

    public function storeTax()
    {
        $tax =new Restaurant_Tax_head();
        $tax->tax_id = $this->taxID;
        $tax->calculation_id = $this->calculationon;
        $tax->base_on = $this->baseon;
        $tax->rate = $this->rate;
        $tax->amount = $this->totalamount;
        $tax->effect = $this->taxEffect();
        $tax->invoice_id = $this->invoice_no;
        $tax->entry_by = Auth::user()->id;
        $tax->entry_date = Carbon::now();
        $tax->save();
    }



    // delete tax item

    
   

}
