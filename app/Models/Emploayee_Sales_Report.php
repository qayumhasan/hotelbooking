<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploayee_Sales_Report extends Model
{
    use HasFactory;

    public function waiter()
    {
        return $this->belongsTo(Employee::class);
    }
}
