<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryManageController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // inventory
    public function index(){
        
        return view('inventory.home.index');
    }
}
