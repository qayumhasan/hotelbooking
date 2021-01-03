<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSetting extends Model
{
    use HasFactory;

    public function getEffectAttribute($value)
    {
        if($value == 1){
            return "Add";
        }else if($value == 0){
            return "Deduct";
        }
    }
}
