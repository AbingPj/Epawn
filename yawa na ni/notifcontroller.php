<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class notifcontroller extends Controller
{
    public function getCategoryRequestNotif(Request $request){
       return DB::table('tbl_item_category')
        ->where('fromUser','=', $request->userId)
        ->get();
    }
    public function getSuperAdminNotif(Request $request){
      return  DB::table('tbl_users')
        ->where('user_id',$request->userId)
        ->get();
    }
    public function removeCategory(Request $request){
        DB::table('tbl_item_category')
        ->where('category_id', $request->categoryId)
        ->delete();
    }

}
