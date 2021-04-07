<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banquet extends Model
{
    use HasFactory;

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
