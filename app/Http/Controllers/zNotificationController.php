<?php

namespace App\Http\Controllers;

use App\zNotifiction;
use Illuminate\Http\Request;

class zNotificationController extends Controller
{
    public function getPawnshopBidNotifications($pawnshop_id)
    {
        // $all = zNotifiction::all()
        //     ->where('pawnshop_id', $pawnshop_id)
        //     ->where('type', 'bid')
        //     ->where('isFromPawnshop', 0);

        $all = zNotifiction::orderBy('date', 'DESC')
            ->where('pawnshop_id', $pawnshop_id)
            ->where('type', 'bid')
            ->where('isFromPawnshop', 0)->get();

        foreach ($all as $key => $value) {
            $value->user = $value->user;
            $value->pawnshop = $value->pawnshop;
        }

        $badge = zNotifiction::all()
            ->where('pawnshop_id', $pawnshop_id)
            ->where('type', 'bid')
            ->where('isFromPawnshop', 0)
            ->where('seen', 0)->count();

        return response()->json(['badge' => $badge, 'notifications' => $all]);
    }
}
