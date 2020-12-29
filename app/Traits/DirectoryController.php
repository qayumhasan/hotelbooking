<?php
namespace App\Traits;

use App\Models\ImageManager;

trait DirectoryController
{ 
    public $name; 
    public function copy($name)
    {
        $name =ImageManager::where('image',$name)->first();
        if($name){
            $this->name = $name->image;
        }else{
            dd('No Image Found!');
        }
        return $this;
    }


    public function to($path)
    {
        
        copy('public/uploads/imagemanager/'.$this->name,$path.'/'.$this->name);
    }

    public function path()
    {
        return $this->name;
    }

    public function size($width,$height)
    {
        return imagecreatefromjpeg ('public/uploads/imagemanager/'.$this->path());
    }

    
}
