<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\ImageManager;
use App\Traits\DirectoryController;

class MediaManagerController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function insert()
    {
        return view('backend.pages.add_post');
    }

    public function mediaManager(Request $request)
    {
        $request->validate([
            'image'=>'required|image'
        ]);

        if ($request->hasFile('image')) {
            $imageid = rand(9999,999999);
            $about_img = $request->file('image');
            $imagename = $imageid . '.' . $about_img->getClientOriginalExtension();
            Image::make($about_img)->save(base_path('public/uploads/imagemanager/' . $imagename), 100);
            $image = new ImageManager;
            $image->image = $imagename;
            $image->save();
            $images = ImageManager::orderby('id','DESC')->paginate(28);
            return view('backend.pages.ajax.addpost',compact('images'));
        }

        // session()->flash('modalshow', '---');
        // return back();

        
        

    }


    public function getImage(Request $request)
    {
        $img =ImageManager::findOrFail($request->imgID);
        return response()->json($img);
    }

    public function showImage()
    {
        $images = ImageManager::orderby('id','DESC')->paginate(28);
        return view('backend.pages.ajax.addpost',compact('images'));
    }

    public function showPaginationImage($id)
    {
        $per_page = 28;
        $start_form = ($id - 1) * $per_page;
        $images = ImageManager::orderby('id','DESC')->skip($start_form)->take($per_page)->get();
        return view('backend.pages.ajax.addpost',compact('images'));   
    }

    public function mediaDelete($id)
    {
        $imgdelete = ImageManager::findOrFail($id);
        if($imgdelete){
            $link =base_path('public/uploads/imagemanager/' . $imgdelete->image);
            unlink($link);
            $imgdelete->delete();
        }

        $images = ImageManager::orderby('id','DESC')->paginate(28);
        return view('backend.pages.ajax.addpost',compact('images'));

    }

    public function test()
    {
        
        $this->copy('4273945.png')
                ->to('public/uploads/test/');
 
    }
}
