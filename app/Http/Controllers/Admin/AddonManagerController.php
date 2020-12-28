<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Artisan;


class AddonManagerController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index()
    {
        return view('backend.addon.index');
    }
    public function store(Request $request)
    {
        if ($request->hasFile('addon_zip')) {
            $dir = 'addons';
            if (!is_dir($dir))
                mkdir($dir, 0777, true);
            
            // store addon on storege
            
            $path = Storage::disk('local')->put('addons', $request->addon_zip);
            $zipped_file_name = $request->addon_zip->getClientOriginalName();
            //Unzip uploaded update file and remove zip file.
            $zip = new ZipArchive;

            $res = $zip->open(base_path('storage/app/'.$path));

            $random_dir = Str::random(10);
 
             $dir = trim($zip->getNameIndex(0), '/');

             if ($res === true) {
                $res = $zip->extractTo(base_path().'/addons/'.$random_dir);
                
                $zip->close();
                //unlink($path);
            }
            else {
                dd('could not open');
            }

            $str = file_get_contents(base_path().'/addons/'.$random_dir.'/config.json');
             $json = json_decode($str, true);


             $addoncheck = Addon::where('unique_identifier',$json['unique_identifier'])->first();

             if($addoncheck){
                $notification = array(
                    'messege' => 'Addon is already installed!',
                    'alert-type' =>'success'
                    );
                return redirect()->back()->with($notification);
             }

            //  store addon
                    $addon = new Addon();
                    $addon->name = $json['name'];
                    $addon->unique_identifier = $json['unique_identifier'];
                    $addon->version = $json['version'];
                    $addon->image = $json['addon_banner'];
                    $addon->save();

               // Run sql modifications
            $sql_path = base_path().'/addons/'.$random_dir.'/sql/update.sql';
            
            $database =file_get_contents($sql_path);
          
            
            if(file_exists($sql_path)){
                        
            //    DB::unprepared(file_get_contents($sql_path));
                Artisan::call('migrate');
            
            
            }


               // Create new directories.
               if (!empty($json['directory'])) {
                //dd($json['directory'][0]['name']);
                foreach ($json['directory'][0]['name'] as $directory) {
                    if (is_dir(base_path($directory)) == false){
                        mkdir(base_path($directory), 0777, true);

                    }else {
                        echo "error on creating directory";
                    }

                }
            }

             // Create/Replace new files.
             if (!empty($json['files'])) {

                foreach ($json['files'] as $file){
                    
                    copy(base_path('addons/'.$random_dir.'/'.$file['root_directory']), base_path($file['update_directory']));
                }

            }

            unlink(base_path('storage/app/'.$path));
      
        } //end store method
        
        $notification = array(
            'messege' => 'Addon is installed Successfully!',
            'alert-type' =>'success'
            );
        return redirect()->back()->with($notification);
    }


    public function status(Request $request)
    {
        $addon = Addon::findOrFail($request->addonid);

        if($addon->status == 1){
            $addon->status = 0;
            $addon->save();
        }else{
            $addon->status = 1;
            $addon->save();
        }
        return response()->json([
            'message'=>'Status Change Successfully!',
        ]);
    }

    public function delete($id)
    {
        Addon::findOrFail($id)->delete();

        $notification = array(
            'messege' => 'Addon is Deleted Successfully!',
            'alert-type' =>'success'
            );
        return redirect()->back()->with($notification);
    }

}
