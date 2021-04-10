<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

        /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function getStatusAttribute()
    {
        if($this->attributes['is_default'] == '1'){
            return '<button type="button" class="btn btn-primary">Active</button>';
        }else{
            return '<button type="button" class="btn btn-danger">In Active</button>';
        }
    }
}
