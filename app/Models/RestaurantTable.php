<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function tableType()
    {
        return $this->belongsTo(RestaurantTableType::class);
    }

    public function waiter()
    {
        return $this->belongsTo(Employee::class);
    }


}
