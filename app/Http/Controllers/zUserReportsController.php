<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_user_report;

class zUserReportsController extends Controller
{
    public function sendReport(Request $request){

        $report = new tbl_user_report;
        $report->userId =  $request->userId;
        $report->pawnshopId =  $request->pawnshopId;
        $report->situation =   $request->situation;
        $report->isFromPawnshop =  $request->isFromPawnshop;
        $report->save();

       $number_of_reports = tbl_user_report::all()->where('userId', $request->userId)->count();
       if($number_of_reports > 3 ){

       }else{

       }
    }

     public function sendReport2($userId,$pawnshopId,$situation,$isFromPawnshop){
        dd($userId);
        $report = new tbl_user_report;
        $report->userId =  $userId;
        $report->pawnshopId =  $pawnshopId;
        $report->situation =   $situation;
        $report->isFromPawnshop =  $isFromPawnshop;
        $report->save();

       $number_of_reports = tbl_user_report::all()->where('userId', $userId)->count();
      return response()->json($report);
    }

    public function getReports(){

        $reports = tbl_user_report::all()->where('isFromPawnshop', 1);

        foreach ($reports as $key => $report) {
            $report->user = $report->user;
            $report->pawnshop = $report->pawnshop;
        }

         return response()->json($reports);
    }

    


   

}
