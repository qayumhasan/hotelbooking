<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use App\Models\AccountMainCategory;
use App\Models\AccountSubCategoryOne;
use App\Models\AccountSubCategoryTwo;
use App\Models\ChartOfAccount;
use Auth;
use CArbon\Carbon;
use DB;


class ChartOfAccountController extends Controller
{
    
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $alldata=ChartOfAccount::where('is_deleted',0)->get();
        // $users = DB::table('PurchaseOrderStockTbl')->get();
        // dd($users);

        return view('accounts.chartofaccount.index',compact('alldata'));
    }

    public function create(){
       // PurchaseOrderStockTbl


        $allcategory=AccountCategory::get();
        $allmaincategory=AccountMainCategory::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        return view('accounts.chartofaccount.create',compact('allcategory','allmaincategory','allsubcategoryone','allsubcategorytwo'));
    }
    // store
    public function store(Request $request){


        $validated = $request->validate([
            'category_name' => 'required',
            'desription_of_account' => 'required',
            'maincategory_name' => 'required',
            'subcateone' => 'required',
            'subcate_two' => 'required',
        ]);
        $category=AccountCategory::where('id',$request->category_name)->select(['category_name','category_code'])->first();
        $maincategory=AccountMainCategory::where('id',$request->maincategory_name)->select(['maincategory_name','maincategory_code'])->first();
        $subcategoryone=AccountSubCategoryOne::where('id',$request->subcateone)->select(['subcategory_nameone','subcategory_codeone'])->first();
        $subcategorytwo=AccountSubCategoryTwo::where('id',$request->subcate_two)->select(['subcategory_nametwo','subcategory_codetwo'])->first();

        $insert=ChartOfAccount::insertGetId([
            'desription_of_account'=>$request->desription_of_account,

            'category_id'=>$request->category_name,
            'category_name'=>$category->category_name,
            'category_code'=>$category->category_code,

            'maincategory_id'=>$request->maincategory_name,
            'maincategory_name'=>$maincategory->maincategory_name,
            'maincategory_code'=>$maincategory->maincategory_code,

            'subcategoryone_id'=>$request->subcateone,
            'subcategoryone_name'=>$subcategoryone->subcategory_nameone,
            'subcategoryone_code'=>$subcategoryone->subcategory_codeone,

            'subcategorytwo_id'=>$request->subcate_two,
            'subcategorytwo_name'=>$subcategorytwo->subcategory_nametwo,
            'subcategorytwo_code'=>$subcategorytwo->subcategory_codetwo,
    
            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateString(),
            'entry_by'=>Auth::user()->id,

        ]);
        $resturl =str_pad($insert, 4, '0', STR_PAD_LEFT);
        ChartOfAccount::where('id',$insert)->update([
            'code'=> $maincategory->maincategory_code.'-'.$subcategoryone->subcategory_codeone.'-'.$subcategorytwo->subcategory_codetwo.'-'.$resturl,
            'code_int'=> $maincategory->maincategory_code.$subcategoryone->subcategory_codeone.$subcategorytwo->subcategory_codetwo.$resturl,
        ]);

        if($insert) {
            $notification = array(
                'messege' => 'Insert Success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Insert Faild',
                'alert-type' => 'error'
            );
        }
    }
    // main cate
    public function maincate($cate_id){
       
        $data=AccountMainCategory::where('is_deleted',0)->where('is_active',1)->where('category_id',$cate_id)->get();
        return response()->json($data);
    }

    //get main code
    public function getmaincatecode($cate_id){
        //return "ok";
        $code=AccountCategory::where('is_deleted',0)->where('is_active',1)->where('id',$cate_id)->select(['category_code'])->first();
        return response()->json($code);
    } 
    
    // subcateone
    public function subcateone($maincate_id){
        $data=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->where('maincategory_id',$maincate_id)->get();
        return response()->json($data);
    }
    
    public function getcatemaincode($maincate_id){
        $code=AccountMainCategory::where('is_deleted',0)->where('is_active',1)->where('id',$maincate_id)->select(['maincategory_code'])->first();
        return response()->json($code);
    }


    // sub cate two
    public function subcatetwo($subcateone_id){
        $data=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->where('subcategoryone_id',$subcateone_id)->get();
       
        return response()->json($data);
    }
    public function getsubcateonecode($subcateone_id){
        $data=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->where('id',$subcateone_id)->select(['subcategory_codeone'])->first();
       
        return response()->json($data);
    }
    
    public function getsubcatetwocode($subcateone_id){
        $data=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->where('id',$subcateone_id)->select(['subcategory_codetwo'])->first();
       
        return response()->json($data);
    }
    

    public function active($id){
        //return "ok";
        $active=ChartOfAccount::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'ChartOfAccount Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'ChartOfAccount Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // deactive
    public function deactive($id){
        //return "ok";
        $deactive=ChartOfAccount::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'ChartOfAccount DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'ChartOfAccount DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete

     // edit
    public function edit($id){
        // return $id;
        $edit=ChartOfAccount::where('id',$id)->first();
      
       $allcategory=AccountCategory::get();

        return view('accounts.chartofaccount.update',compact('edit','allcategory'));
    }
    // updaate
    public function updateone(Request $request){

        $validated = $request->validate([
            'maincategory' => 'required',
            'subcategory_nameone' => 'required',
        ]);
        $maincate_id=AccountMainCategory::where('id',$request->maincategory)->select(['maincategory_code','maincategory_name'])->first();
        $updated=AccountSubCategoryOne::where('id',$request->id)->update([
            'maincategory_name'=>$maincate_id->maincategory_name,
            'maincategory_code'=>$maincate_id->maincategory_code,
            'maincategory_id'=>$request->maincategory,
            'subcategory_nameone'=>$request->subcategory_nameone,
            'is_active'=>$request->is_active,
            'updated_at'=>Carbon::now()->toDateString(),
            'updated_by'=>Auth::user()->id,
        ]);
        if($updated){
            $notification = array(
                'messege' => 'Updated Success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Updated Faild',
                'alert-type' => 'error'
            );
        }
     
        
    }
    // 
    public function delete($id){
        $delete=ChartOfAccount::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'ChartOfAccount Delete success',
                'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'ChartOfAccount Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
    // update
    public function update(Request $request){
        $validated = $request->validate([
            'desription_of_account' => 'required',
        ]);
        $insert=ChartOfAccount::where('id',$request->id)->update([
            'desription_of_account'=>$request->desription_of_account,
            'is_active'=>$request->is_active,
            'updated_at'=>Carbon::now()->toDateString(),
            'updated_by'=>Auth::user()->id,

        ]);

        if($insert) {
            $notification = array(
                'messege' => 'update Success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'update Faild',
                'alert-type' => 'error'
            );
        }
    }


}
