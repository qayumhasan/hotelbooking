<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use App\Http\Resources\BanquestCollection;
use App\Models\Banquet;
use Illuminate\Http\Request;

class BanquetController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
        return view('banquet.home.index');
    }


    public function getBanqueet()
    {
        $banquets = Banquet::with('venue')->where('is_active',1)->where('is_deleted',0)->get();

        return new BanquestCollection($banquets);
        
    }
}
