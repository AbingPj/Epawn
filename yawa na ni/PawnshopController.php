<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PawnshopController extends Controller
{
    public function getPawnshops(Request $request){
      
        return DB::table('tbl_bid_item')
        ->join('tbl_users','tbl_users.user_id','=','tbl_bid_item.pawnshop_id')
        ->where('tbl_bid_item.user_id', $request->userId)
        ->groupBy('tbl_bid_item.pawnshop_id')
        ->get();
    }
    public function getAllPawnshops(){
      
        return DB::table('tbl_users')
        ->where('role_id', '2')
        ->get();
    }
    public function getSinglePawnshops(Request $request){
      
        return DB::table('tbl_users')
        ->where('role_id', '2')
        ->where('user_id',$request->userId)
        ->get();
        
    }
}
