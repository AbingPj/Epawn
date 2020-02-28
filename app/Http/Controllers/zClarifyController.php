<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\zPackage;
use App\zPackageDuration;
use App\zPawnedItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class zClarifyController extends Controller
{
    public function zSavePackage(Request $request)
    {

        DB::transaction(function () use ($request) {
            $pack = new zPackage;
            $pack->pawnshop_id = $request->pawnshop_id;
            $pack->package_name =  $request->package_name;
            $pack->package_desc =  $request->package_desc;
            $pack->number_of_month =  $request->number_of_month;
            $pack->interest_per_month =  $request->interest_per_month;
            $pack->pinalty_per_month =  $request->pinalty_per_month;
            $pack->if_advance_interest =  $request->if_advance_interest;
            $count = count($request->durations);
            if ($count > 0) {
                $pack->if_has_special_offer = 1;
            } else {
                $pack->if_has_special_offer = 0;
            }
            $pack->save();
            foreach ($request->durations as $key => $duration) {
                $dur = new zPackageDuration;
                $dur->package_id = $pack->id;
                $dur->from = $duration['from'];
                $dur->to = $duration['to'];
                $dur->interest = $duration['interest'];
                $dur->save();
            }
        });
    }

    public function zSavePawnedItem(Request $request)
    {

        DB::transaction(function () use ($request) {
            $pawned = new zPawnedItem;
            $pawned->item_id = $request->item_id;
            $pawned->pawnshop_id =  $request->pawnshop_id;
            $pawned->customer_id =  $request->customer_id;
            $pawned->package_id =  $request->package_id;
            $pawned->pawn_amount =  $request->pawn_amount;
            $pawned->date_pawned =  Carbon::now('Asia/Manila');
            $pawned->date_renew =  Carbon::now('Asia/Manila');
            $pawned->days_deadline =   $request->days_deadline;
            // $pawned->date_claimed =  Carbon::now('Asia/Manila'); 
            $pawned->is_claimed = 0;
            $pawned->is_confiscated = 0;
            $pawned->save();
        });
    }


    public function zGetPackages($pawnshop_id)
    {
        $packages = zPackage::all()->where('pawnshop_id', $pawnshop_id);
        foreach ($packages as $key => $pack) {
            $pack->durations = $pack->durations;
        }
        return $packages;
    }

    public function getPawnedItemCalculations($package_id, $amount)
    {
        //  $dt = Carbon::now();
        $dt = Carbon::now('Asia/Manila');
        $package = zPackage::find($package_id);
        $durations = $package->durations;
        $specials = [];
        $monthly = [];
        $data = [];
        $dt->subDays(1);
        if ($package->if_has_special_offer == 1) {
            foreach ($durations as $key => $duration) {
                $dt->addDays(1);
                $dateFrom = $dt;
                $from = $dateFrom->format('M.d,Y');
                $number_of_days = (($duration->to) - $duration->from);
                $dateTo = $dt->addDays($number_of_days);
                $to = $dateTo->format('M.d,Y');
                $interest = $duration->interest / 100;
                $renewal = ($amount * $interest);
                $claim_without_advance_interest = ($amount + $renewal);
                // if ($package->if_advance_interest == 1) {
                $interest_percentage = $package->interest_per_month / 100;
                $claim_with_advance_interest = $claim_without_advance_interest - ($amount * $interest_percentage);
                // }
                if ($package->if_advance_interest == 1) {
                    $redemption = $claim_with_advance_interest;
                 }else{
                    $redemption = $claim_without_advance_interest;
                 }
                $obj = array(
                    'index' => $key,
                    'from' => $from,
                    'to' => $to,
                    'number_of_days' => ($number_of_days + 1),
                    'interest' => $duration->interest,
                    'renewal' => $renewal,
                    'claim_without_advance_interest' => $claim_without_advance_interest,
                    'claim_with_advance_interest' =>  $claim_with_advance_interest,
                    'redemption' => $redemption
                );
                array_push($specials, $obj);
            }
        }
        $dt2 = Carbon::now('Asia/Manila');
        $number_of_month = $package->number_of_month;

        if ($package->if_has_special_offer == 1) {
            $index = 1;
            $dt2->addMonth();
        } else {
            $index = 0;
         
        }
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

            $obj = array(
                'index' => $i,
                'month' => $month->format('M.d,Y'),
                'total_interest' => $total_interest,
                'total_interest_rate' => $total_interest_rate,
                'amount' => $amount,
                'interest_per_month' => $package->interest_per_month,
                'interest' => $interest,
                'penalty' => $pinalty,
                'renewal' => $renewal,
                'claim_without_advance_interest' => $claim_without_advance_interest,
                'claim_with_advance_interest' =>  $claim_with_advance_interest,
                'redemption' => $redemption
            );
            array_push($monthly, $obj);
        }
        $obj = array(
            'package' => $package,
            'specials' => $specials,
            'monthly' => $monthly,
        );
        array_push($data, $obj);
        return response()->json($data);
    }

    public function getPawnedItemPaymentDetails($package_id, $amount, $date)
    {
        $dt = Carbon::parse($date);
        $datePawned = Carbon::parse($date);
        // $dateNow = Carbon::now('Asia/Manila');
        
        // $dt = Carbon::now('Asia/Manila');
        $package = zPackage::find($package_id);
        $durations = $package->durations;
        $specials = [];
        $monthly = [];
        $data = [];
        $dt->subDays(1);

        $dateNow = Carbon::now('Asia/Manila');
        // $dateNow = Carbon::parse('2020-02-10 14:50:11');
        $stop = false;
        $currentPayment = 0;


    
        if ($package->if_has_special_offer == 1) {
            foreach ($durations as $key => $duration) {
                $dt->addDays(1);
                $dateFrom = $dt;
                $from = $dateFrom->format('M.d,Y');
                $number_of_days = (($duration->to) - $duration->from);
                $dateTo = $dt->addDays($number_of_days);
               
                $to = $dateTo->format('M.d,Y');
                $interest = $duration->interest / 100;
                $renewal = ($amount * $interest);
                $claim_without_advance_interest = ($amount + $renewal);
                // if ($package->if_advance_interest == 1) {
                $interest_percentage = $package->interest_per_month / 100;
                $claim_with_advance_interest = $claim_without_advance_interest - ($amount * $interest_percentage);
                // }
                if ($package->if_advance_interest == 1) {
                    $redemption = $claim_with_advance_interest;
                 }else{
                    $redemption = $claim_without_advance_interest;
                 }

                if($dateNow <= $dateTo &&  $stop == false){
                    $currentPayment = $redemption;
                    $stop = true;
                }
               

                $obj = array(
                    'index' => $key,
                    'from' => $from,
                    'to' => $to,
                    'number_of_days' => ($number_of_days + 1),
                    'interest' => $duration->interest,
                    'renewal' => $renewal,
                    'claim_without_advance_interest' => $claim_without_advance_interest,
                    'claim_with_advance_interest' =>  $claim_with_advance_interest,
                    'redemption' => $redemption
                );
                array_push($specials, $obj);
            }
        }

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

            if($dateNow <= $month &&  $stop == false){
                $currentPayment = $redemption;
                $stop = true;
            }

            $obj = array(
                'index' => $i,
                'month' => $month->format('M.d,Y'),
                'total_interest' => $total_interest,
                'total_interest_rate' => $total_interest_rate,
                'amount' => $amount,
                'interest_per_month' => $package->interest_per_month,
                'interest' => $interest,
                'penalty' => $pinalty,
                'renewal' => $renewal,
                'claim_without_advance_interest' => $claim_without_advance_interest,
                'claim_with_advance_interest' =>  $claim_with_advance_interest,
                'redemption' => $redemption
            );
            array_push($monthly, $obj);
        }
        $obj = array(
            'date_now' => $dateNow,
            'current_payment' => $currentPayment,
            'specials' => $specials,
            'monthly' => $monthly,
            'package' => $package,
           
        );
        array_push($data, $obj);
        return response()->json($data);
    }


       // echo $dt->addMonths(60);                 // 2017-01-31 00:00:00
        // echo $dt->addMonth();                    // 2017-03-03 00:00:00 equivalent of $dt->month($dt->month + 1); so it wraps
        // echo $dt->subMonth();                    // 2017-02-03 00:00:00
        // echo $dt->subMonths(60);                 // 2012-02-03 00:00:00
        // echo $dt->addDays(29);                   // 2012-03-03 00:00:00
        // echo $dt->addDay();                      // 2012-03-04 00:00:00
        // echo $dt->subDay();                      // 2012-03-03 00:00:00
        // echo $dt->subDays(29);
        //  $firstDayofPreviousMonth = $now->startOfMonth()->toDateString();
        //             $lastDayofPreviousMonth = $now->endOfMonth()->toDateString();
        //             $month = $PreviousMonth->month;
        //             $year = $PreviousMonth->year;
}
