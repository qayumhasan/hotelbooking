<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function create()
    {
        return view('hotelbooking.checking.voucher.create');
    }
}
