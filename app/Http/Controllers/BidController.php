<?php

namespace App\Http\Controllers;

use App\Events\EpawnEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    public function placeBid(Request $request)
    {
        DB::table('tbl_bid_item')
            ->insert([
                'item_id' => $request->itemId,
                'bid_price' => $request->bidamount,

                'user_id' => $request->userId,
                'pawnshop_id' => $request->pawnshopId,
                'bid_from' => $request->bid_from,
                'bid_to' => $request->bid_to,
                'isFromPawnshop' => $request->isFromPawnshop
            ]);
        broadcast(new EpawnEvent('bid'));
    }
    public function getBidPlacements($itemId, $bidderId, $pawnshopId)
    {
        return DB::table('tbl_bid_item')
            ->where('item_id', '=', $itemId)
            ->where('user_id', '=', $bidderId)
            ->where('pawnshop_id', '=', $pawnshopId)
            ->get();
    }
    public function closeDeal(Request $request)
    {
        DB::table('tbl_user_itempost')
            ->where('item_id', $request->item_id)
            ->update([
                'status' => '1',
                'initial_amount' => $request->bid_price,
                'pawnshop_id' => $request->pawnshop_id
            ]);
        broadcast(new EpawnEvent('getItems'));
    }
    public function getMyBiddings(Request $request)
    {
        return  DB::table('tbl_user_itempost')
            ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_user_itempost.category_id')
            ->join('tbl_users', 'tbl_users.user_id', '=', 'tbl_user_itempost.user_id')
            ->where('tbl_user_itempost.pawnshop_id', $request->pawnshop_id)
            ->where('status', 1)
            ->get();
    }
    public function getBiddingRecords(Request $request)
    {
        return  DB::table('tbl_user_itempost')
            ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_user_itempost.category_id')
            ->join('tbl_users', 'tbl_users.user_id', '=', 'tbl_user_itempost.user_id')
            ->Join('tbl_pawned_items', 'tbl_pawned_items.item_id', '=', 'tbl_user_itempost.item_id')
            ->where('tbl_user_itempost.pawnshop_id', $request->pawnshop_id)
            ->where('tbl_user_itempost.status', '<>', 1)
            ->get();
    }
    public function acceptDeal(Request $request)
    {
        DB::table('tbl_user_itempost')
            ->where('item_id', $request->item_id)
            ->update([
                'status' => '2'
            ]);

        DB::table('tbl_pawned_items')
            ->insert([
                'pawnshop_id' => $request->pawnshop_id,
                'item_id' => $request->item_id,
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'days_deadline' => $request->days_deadline,
                'months_ext'  => $request->months_ext,
                'bid_from' => $request->bid_from,
                'bid_to' => $request->bid_to,
                'interest_per_durationdays' => $request->interest_per_durationdays,
                'pawn_amount' => $request->pawn_amount
            ]);
    }
    public function rejectDeal(Request $request)
    {
        DB::table('tbl_user_itempost')
            ->where('item_id', $request->item_id)
            ->update([
                'status' => '4'
            ]);

        DB::table('tbl_pawned_items')
            ->insert([
                'pawnshop_id' => $request->pawnshop_id,
                'item_id' => $request->item_id,
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'days_deadline' => $request->days_deadline,
                'months_ext'  => $request->months_ext,
                'pawn_reason' => $request->reason,
                'pawn_amount' => $request->amount
            ]);
    }

    //functions below are for mobile
    public function getUserBiddings(Request $request)
    {
        return  DB::table('tbl_user_itempost')
            ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_user_itempost.category_id')
            ->join('tbl_users', 'tbl_users.user_id', '=', 'tbl_user_itempost.pawnshop_id')
            ->where('tbl_user_itempost.user_id', $request->userId)
            ->where('tbl_user_itempost.status', 1)
            ->get();
    }

    public function getActiveBiddings(Request $request)
    {
        return  DB::table('tbl_user_itempost')
            ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_user_itempost.category_id')
            ->join('tbl_bid_item', 'tbl_bid_item.item_id', '=', 'tbl_user_itempost.item_id')
            ->leftJoin('tbl_users', 'tbl_users.user_id', '=', 'tbl_bid_item.pawnshop_id')
            ->where('tbl_bid_item.user_id', $request->userId)
            ->where('tbl_user_itempost.status', $request->status)
            ->groupBy('tbl_users.user_id')
            ->select('*', DB::raw('MAX(tbl_bid_item.bid_to) as bid_max_value'))
            ->get();
    }

    public function getUserBiddingRecords(Request $request)
    {
        return  DB::table('tbl_user_itempost')
            ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_user_itempost.category_id')
            ->join('tbl_users', 'tbl_users.user_id', '=', 'tbl_user_itempost.pawnshop_id')
            ->Join('tbl_pawned_items', 'tbl_pawned_items.item_id', '=', 'tbl_user_itempost.item_id')
            ->where('tbl_user_itempost.user_id', $request->userId)
            ->where('tbl_user_itempost.status', '<>', 1)
            ->where('tbl_user_itempost.status', '<>', 0)
            ->get();
    }

    //    public function getPawnshopsOnBid(Request $request)
    //    {
    //        return DB::table('tbl_bid_item')
    //        ->join('tbl_users','tbl_users.user_id','=','tbl_bid_item.pawnshop_id')
    //        ->where('tbl_bid_item.item_id',$request->itemId)
    //        ->where('tbl_bid_item.user_id', $request->userId)
    //        ->groupBy('tbl_users.fname')
    //        ->get();
    //    }

    public function getPawnshopsOnBid(Request $request)
    {
        return DB::table('tbl_bid_item')
            ->join('tbl_users', 'tbl_users.user_id', '=', 'tbl_bid_item.pawnshop_id')
            ->where('tbl_bid_item.item_id', $request->itemId)
            ->where('tbl_bid_item.user_id', $request->userId)
            ->groupBy('tbl_users.fname')
            ->select('*', DB::raw('MAX(tbl_bid_item.bid_to) as bid_max_value'))
            ->get();
    }
}
