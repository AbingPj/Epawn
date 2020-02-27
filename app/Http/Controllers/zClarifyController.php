<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\zPackage;
use App\zPackageDuration;
use App\zPawnedItem;
use Carbon\Carbon;

class zClarifyController extends Controller
{
    public function zSavePackage(Request $request){
        $pack = new zPackage; 
        $pack->pawnshop_id = $request->pawnshop_id; 
        $pack->package_name =  $request->package_name;
        $pack->package_desc =  $request->package_desc;
        $pack->number_of_month =  $request->number_of_month;
        $pack->interest_per_month =  $request->interest_per_month;
        $pack->pinalty_per_month =  $request->pinalty_per_month;
        $pack->if_advance_interest =  $request->if_advance_interest;
        $count = count($request->durations);
        if($count == 0){
            $pack->if_has_special_offer = 1;
        }
        $pack->save();
        foreach ($request->durations as $key => $duration) {
            $dur = new zPackageDuration;
            $dur->packaged_id = $pack->id;
            $dur->from = $duration['from'];
            $dur->to = $duration['to'];
            $dur->interest = $duration['interest'];
            $dur->save();
        }
    }
    public function zGetPackages($pawnshop_id){
        $packages = zPackage::all()->where('pawnshop_id', $pawnshop_id);
        foreach ($packages as $key => $pack) {
            $pack->durations = $pack->durations;
        }
        return $packages;
    }

    public function getPawnedItemCalculations($package_id,$amount){
        //  $dt = Carbon::now();
         $dt = Carbon::now('Asia/Manila');
         $package = zPackage::find($package_id);
         $durations = $package->durations;
         $specials = [];
         $monthly = [];
         $data = [];

        //  $Object1->Object2 = $Object2;
       
        
         foreach ($durations as $key => $duration) {
             
            $dateFrom = $dt;
            $from = $dateFrom->toDateString();
            $number_of_days = (($duration->to + 1) - $duration->from);
            $dateTo = $dt->addDays($number_of_days);
            $to = $dateTo->toDateString();
            $interest = $duration->interest / 100;
            $renewal = ($amount * $interest);
            $claim_without_advance_interest = ($amount + $renewal);

            if($package->if_advance_interest == 1){
                  $interest_percentage = $package->interest_per_month / 100;
                  $claim_with_advance_interest = $claim_without_advance_interest - ($amount * $interest_percentage);
            }
 
            $obj = array(     
                   'from' => $from,
                    'to' => $to,
                    'interest' => $duration->interest,
                    'renewal' => $renewal,
                    'claim_without_advance_interest' => $claim_without_advance_interest,
                    'claim_with_advance_interest' =>  $claim_with_advance_interest
             );
            array_push($specials, $obj);
            $dt->addDays(1);
         }



          $dt2 = Carbon::now('Asia/Manila');

         $number_of_month = $package->number_of_month;
        
         for ($i=0; $i < $number_of_month ; $i++) { 
             $month = $dt2->addMonth();
            //  dump($month->toDateString());
            //  dump($amount);
             $interest = ($package->interest_per_month * ($i + 1 ))/100;
            //  dump( $interest);
            //  dump( ($amount * $interest));
             $pinalty =   ($package->pinalty_per_month * $i)/100;
            //  dump( $pinalty);
            //  dump( ($amount * $pinalty));
             $renewal = ($amount * $interest) + ($amount * $pinalty);
            //  dump($renewal);
             $claim_without_advance_interest  = $amount + $renewal;
            //  dump($claim_payment);
             if($package->if_advance_interest == 1){
                 $interest_percentage = $package->interest_per_month / 100;
                 $claim_with_advance_interest = $claim_without_advance_interest - ($amount * $interest_percentage);
             }

              $obj = array(     
                   'month' => $month->toDateString(),
                    'amount' => $amount,
                    'interest_per_month' => $package->interest_per_month,
                    'interest' => $interest,
                    'penalty' => $pinalty,
                    'renewal' => $renewal,
                    'claim_without_advance_interest' => $claim_without_advance_interest,
                    'claim_with_advance_interest' =>  $claim_with_advance_interest
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
}
