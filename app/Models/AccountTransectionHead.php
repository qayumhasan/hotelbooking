<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransectionHead extends Model
{
    use HasFactory;

      /**
     * Get the phone associated with the user.
     */
    public function details()
    {
        return $this->hasOne(AccountTransectionDetails::class,'voucher_no','voucher_no')->where('is_active',1)->where('is_deleted',0);
    }
}
