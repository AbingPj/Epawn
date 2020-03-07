<?php

namespace App\Http\Controllers;

use App\tbl_user_itempost;
use App\zPawnedItem;
use App\zPackage;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class mobileApiController extends Controller
{

    public $claim_payment = 0;
    public $renew_payment = 0;

    public function getUserBiddings2(Request $request)
    {
        // return  DB::table('tbl_user_itempost')
        //     ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_user_itempost.category_id')
        //     ->join('tbl_users', 'tbl_users.user_id', '=', 'tbl_user_itempost.pawnshop_id')
        //     ->where('tbl_user_itempost.user_id', $request->userId)
        //     ->where('tbl_user_itempost.status', 1)
        //     ->get();
        

        $data = tbl_user_itempost::all()->where('user_id', $request->userId)->where('status', 1);

        foreach ($data as $key => $item) {
            $item->user = $item->user;
            $item->category = $item->category;
        }
       
        return response()->json($data);
    }

    public function getUserBiddingRecords2(Request $request)
    {

        $useri_id = $request->userId;
        $pawned_items = zPawnedItem::all()
            ->where('customer_id', $useri_id)
            ->where('is_rejected', 0);
        foreach ($pawned_items as $key => $pawned_item) {
            $pawnshop = $pawned_item->pawnshop;
            $customer = $pawned_item->user;
            $item = $pawned_item->item;
            $category = $pawned_item->item->category;
            $this->getPawnedItemPaymentDetails($pawned_item->package_id, $pawned_item->pawn_amount, $pawned_item->date_renew);
            $pawned_item->payment_claimed = $this->claim_payment;
            $pawned_item->payment_renew = $this->renew_payment;
           
        }
        return response()->json($pawned_items);
    }


    public function getPawnedItemPaymentDetails($package_id, $amount, $date)
    {
        $dt = Carbon::parse($date);
        $datePawned = Carbon::parse($date);
        // $dateNow = Carbon::now('Asia/Manila');

        // $dt = Carbon::now('Asia/Manila');
        $package = zPackage::find($package_id);
        if ($package->if_has_special_offer == 1) {
            $durations = $package->durations;
        }
        $specials = [];
        $monthly = [];
        $data = [];
        $dt->subDays(1);

        $dateNow = Carbon::now('Asia/Manila');
        // $dateNow = Carbon::parse('2020-02-10 14:50:11');
        $stop = false;
        $currentPayment = 0;
        $currentRenewal = 0;

        if ($package->if_has_special_offer == 1) {
            foreach ($durations as $key => $duration) {
                $dt->addDays(1);
                $dateFrom = $dt;
                $from = $dateFrom->format('M.d,Y');
                $number_of_days = (($duration->duration_to) - $duration->duration_from);
                $dateTo = $dt->addDays($number_of_days);

                $to = $dateTo->format('M.d,Y');
                $interest = $duration->interestRate / 100;
                $renewal = ($amount * $interest);
                $claim_without_advance_interest = ($amount + $renewal);
                // if ($package->if_advance_interest == 1) {
                $interest_percentage = $package->interest_per_month / 100;
                $claim_with_advance_interest = $claim_without_advance_interest - ($amount * $interest_percentage);
                // }
                if ($package->if_advance_interest == 1) {
                    $redemption = $claim_with_advance_interest;
                } else {
                    $redemption = $claim_without_advance_interest;
                }

                if ($dateNow <= $dateTo &&  $stop == false) {
                    $currentPayment = $redemption;
                    $currentRenewal = $renewal;
                    $stop = true;
                }
            }
        }


        // FOR MONTHLY CALCULATION

        // $dt2 = Carbon::now('Asia/Manila');
        $dt2 = Carbon::parse($date);
        $number_of_month = $package->number_of_month;

        if ($package->if_has_special_offer == 1) {
            $index = 1;
            $dt2->addMonth();
        } else {
            $index = 0;
        }
        // $index=0;
        for ($i = $index; $i < $number_of_month; $i++) {
            $month = $dt2->addMonth();
            $interest = ($package->interest_per_month * ($i + 1)) / 100;
            $pinalty = ($package->pinalty_per_month * $i) / 100;
            $total_interest_rate = $interest + $pinalty;
            $total_interest = ($package->interest_per_month * ($i + 1)) + ($package->pinalty_per_month * $i);
            $renewal = ($amount * $interest) + ($amount * $pinalty);

            $claim_without_advance_interest  = $amount + $renewal;
            // if ($package->if_advance_interest == 1) {
            $interest_percentage = $package->interest_per_month / 100;
            $claim_with_advance_interest = $claim_without_advance_interest - ($amount * $interest_percentage);
            // }
            if ($package->if_advance_interest == 1) {
                $redemption = $claim_with_advance_interest;
            } else {
                $redemption = $claim_without_advance_interest;
            }

            if ($dateNow <= $month &&  $stop == false) {
                $currentPayment = $redemption;
                $currentRenewal = $renewal;
                $stop = true;
            }
        }

        $this->claim_payment =  $currentPayment;
        $this->renew_payment =  $currentRenewal;
    }
}
