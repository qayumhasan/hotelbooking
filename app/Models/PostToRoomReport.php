<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostToRoomReport extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vPaymentPostToRoomReport';


    public function getcheckinstatusAttribute($value)
    {
        if($this->is_occupy == 1){
            return "Occupied";
        }else{
            return "Checkouted";
        }
    }


    public function waiter()
    {
        return $this->belongsTo(Employee::class,'waiter_id');
    }
}
