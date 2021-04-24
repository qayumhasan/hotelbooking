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

    /**
     * Get the comments for the blog post.
     */
    public function employeeSalesReport()
    {
        return $this->hasMany(Restaurant_order_detail::class, 'waiter_id', 'waiter_id');
    }

    public function getcountitemsAttribute()
    {
        return $this->employeeSalesReport->sum('qty');
    }
}
