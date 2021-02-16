<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function home(){
        return view('accounts.home.index');
    }
}
