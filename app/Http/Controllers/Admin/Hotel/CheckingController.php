<?php

namespace App\Http\Controllers\Admin\hotel;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class CheckingController extends Controller
{
    public function index($id)
    {
        $room = Room::findOrFail($id);
        return view('hotelbooking.checking.checking',compact('room'));
    }
}
