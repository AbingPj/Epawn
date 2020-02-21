<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PawningController extends Controller
{
   public function getPawnedItem(Request $request){
      return DB::table('tbl_pawned_items')
      ->where('item_id',$request->itemId)
      ->get();
   }
   public function getPaymentHistory(Request $request){
      return DB::table('tbl_payment')
      ->where('pawned_id', $request->itemId)
      ->get();
   }
   public function payPawn(Request $request){
       DB::table('tbl_payment')
       ->insert([
           'pawned_id'=> $request->pawnedId,
           'payment' => $request->payment
       ]);
   }
   public function getPayable(Request $request){
      return DB::table('tbl_pawned_items')
      ->where('tbl_pawned_items.item_id' , $request->itemId)
      ->get();
   }
}
