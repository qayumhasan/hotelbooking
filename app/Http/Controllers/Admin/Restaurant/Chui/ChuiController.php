<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChuiController extends Controller
{
    public function chuiIndex()
    {
        return view('restaurant.chui.home.index');
    }
}
