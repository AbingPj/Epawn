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
    }

    public function getReports(){
        $reports = tbl_user_report::all();
      return response()->json($reports);
    }

}
