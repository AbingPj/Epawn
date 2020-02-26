<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function add(Request $request){
      
        $packageId =  DB::table('tbl_pawnshop_package')->max('package_id');

        DB::table('tbl_package_duration')->insert([
            'package_id' => $packageId,
            'duration_from'=> $request->duration_from,
            'duration_to'=> $request->duration_to,
            'interestRate'=> $request->interestRate
        ]);
    }
    public function edit(Request  $request){
        DB::table('tbl_pawnshop_package')
        ->where('package_id',$request->package_id)
        ->update([
            'package_name' => $request->package_name, 
            'pawnshop_id' => $request->pawnshop_id,
            'package_description' => $request->package_description,
        ]);
        DB::table('tbl_package_duration')->where('package_id',$request->package_id)->delete();
        foreach($request->duration as $duration){
         

            DB::table('tbl_package_duration')
            ->insert([
                'package_id' => $duration['package_id'],
                'duration_from' =>  $duration['duration_from'],
                'duration_to' =>  $duration['duration_to'],
                'interestRate'=>$duration['interestRate']
            ]);
        }
    }
    public function view(){
        return 
        DB::table('tbl_pawnshop_package') ->get();
    }
    public function viewDurations(){
        return DB::table('tbl_package_duration')
        ->orderBy('duration_from','asc')->get();
    }
    public function getDuration(Request $request){
        return DB::table('tbl_package_duration')
        ->where('package_id', $request->packageId)
        ->orderBy('duration_from','asc')->get();
    }
    public function delete(Request $request){
        DB::table('tbl_pawnshop_package')
        ->where('package_id',$request->package_id)
        ->delete();

        DB::table('tbl_package_duration')
        ->where('package_id',$request->package_id)
        ->delete();
    }
    public function addToPawnshop(Request $request){
        DB::table('tbl_pawnshop_package')
        ->insert([
            'package_name' => $request->package_name, 
            'pawnshop_id' => $request->pawnshop_id,
            'package_description' => $request->package_description,
        ]);
    }
    public function getItemCategories(){
        return DB::table('tbl_item_category')
         ->where('valid','1')
         ->get();
    }
    public function addItemCategory(Request $request){
        DB::table('tbl_pawnshop_itemcategory')
         ->insert([
             'pawnshop_id' => $request->pawnshop_id,
             'category_id' => $request->category_id,
         ]);
    }
    public function viewPawnshopCategories(Request $request){
        return DB::table('tbl_pawnshop_itemcategory')
          ->join('tbl_item_category','tbl_item_category.category_id','=','tbl_pawnshop_itemcategory.category_id')
          ->where('pawnshop_id',$request->pawnshop_id)
          ->where('valid','1')
          ->get();
    }
    public function sendCategoryRequest(Request $request){
        DB::table('tbl_item_category')
         ->insert([
             'category_name' => $request->category_name,
             'category_description' => $request->category_description,
             'fromUser'=> $request->category_user,
             'valid' => '0'
         ]);
    }
    public function getPendingCategories(Request $request){
        return DB::table('tbl_item_category')
           ->Leftjoin('tbl_users','tbl_users.user_id','=','tbl_item_category.fromUser')
           ->where('valid',$request->status)
           ->get();
    }
  
    public function acceptCategoryRequest(Request $request){
        DB::table('tbl_item_category')
        ->where('category_id','=',$request->category_id)
        ->update([
            'valid' => '1'
        ]);
    }
    public function declineCategoryRequest(Request $request){
        DB::table('tbl_item_category')
        ->where('category_id','=',$request->category_id)
        ->update([
            'valid' => '3',
            'category_reason' => $request->reason
        ]);
    }
    public function removeItemCategory(Request $request){
        DB::table('tbl_pawnshop_itemcategory')
        ->where('pawnshop_id', $request->pawnshop_id)
        ->where('category_id', $request->category_id)
        ->delete();
    }
    public function getPawnshopPackages(Request $request){
        return DB::table('tbl_pawnshop_package')
        ->where('pawnshop_id',$request->pawnshopId)->get();
    }
}
