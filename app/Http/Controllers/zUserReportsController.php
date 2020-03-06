<?php

namespace App\Http\Controllers;

use App\Events\EpawnEvent;
use App\tbl_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_user_report;
use Carbon\Carbon;

class zUserReportsController extends Controller
{

    public function triggerPusher(Request $request)
    {
        // dd($request->message);
        broadcast(new EpawnEvent($request->message));
    }

    public function triggerPusher2()
    {
        broadcast(new EpawnEvent('add-item'));
        $reports = tbl_user_report::all()->where('isFromPawnshop', 1);

        foreach ($reports as $key => $report) {
            $report->user = $report->user;
            $report->pawnshop = $report->pawnshop;
        }

        return response()->json($reports);
    }

    public function sendReport(Request $request)
    {

        $report = new tbl_user_report;
        $report->userId =  $request->userId;
        $report->pawnshopId =  $request->pawnshopId;
        $report->situation =   $request->situation;
        $report->isFromPawnshop =  $request->isFromPawnshop;
        $report->save();

        $number_of_reports = tbl_user_report::all()->where('userId', $request->userId)->count();
        if ($number_of_reports > 3) { } else { }
    }

    public function sendReport2($userId, $pawnshopId, $situation, $isFromPawnshop)
    {
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

    public function getReports()
    {

        $reports = tbl_user_report::all()->where('isFromPawnshop', 1);

        foreach ($reports as $key => $report) {
            $report->user = $report->user;
            $report->pawnshop = $report->pawnshop;
        }

        return response()->json($reports);
    }


    public function getReports2()
    {
        $users = tbl_user::all()->where('role_id', 3)->where('isValid', 0);
        $users->map(function ($user) {
            $number_of_reports = $user->reports->where('isFromPawnshop', 1)->count();
            $user->number_of_reports = $number_of_reports;
            $user->reports_by = $user->reports->where('isFromPawnshop', 1);
            $user->reports_by->map(function ($row) {
                $row->pawnshop_name  = $row->pawnshop->username;
                $date = Carbon::parse($row->dateReported);
                $row->dateReported = $date->format('M.d,Y');
            });
        });
        $users = $users->reject(function ($row) {
            return $row->number_of_reports < 3;
        });
        return response()->json($users);
    }

    public function sendBlockUser(Request $request)
    {
        $user = tbl_user::find($request->id);
        $user->isValid = 2;
        $user->save();
    }

    public function getBlockUsers()
    {
        $users = tbl_user::all()->where('isValid', 2)->where('role_id', 3);
        return response()->json($users);
    }
}
