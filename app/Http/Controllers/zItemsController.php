<?php

namespace App\Http\Controllers;

use App\tbl_user_itempost;
use App\zPawnedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class zItemsController extends Controller
{
    
    public function getAllItems(){
        $items = tbl_user_itempost::all();
        foreach ($items as $key => $item) {
            $user = $item->user;
            $category = $item->category;
        }
        return response()->json($items);
    }

    public function getAllPostedItems()
    {
        $items = tbl_user_itempost::all()->where('status', 1);
        foreach ($items as $key => $item) {
            $user = $item->user;
            $category = $item->category;
        }
        return response()->json($items);
    }

    public function getPendingItems($pawnshop_id){

        // return  DB::table('tbl_user_itempost')
        //     ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_user_itempost.category_id')
        //     ->join('tbl_users', 'tbl_users.user_id', '=', 'tbl_user_itempost.user_id')
        //     ->where('tbl_user_itempost.pawnshop_id', $pawnshop_id)
        //     ->where('status', 1)
        //     ->get();

        $data = tbl_user_itempost::all()->where('pawnshop_id',$pawnshop_id)->where('status',1);
        foreach ($data as $key => $item) {
           $item->user = $item->user;
           $item->category = $item->category;
        }
        // array_push($data, $PendingItems);
        return response()->json($data);
    }

    public function getPawenedItems($pawnshop_id){

        $items = zPawnedItem::all()->where('pawnshop_id', $pawnshop_id);
        foreach ($items as $key => $item) {
            $item->customer_name = $item->customer->username;
            $item->item_name = $item->item->item_name;
            $category = $item->item->category;
        }

       
        return response()->json($items);
    }

}
