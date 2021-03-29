<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }


    public function datewisereport(){
        return 'ok';
    }
}
