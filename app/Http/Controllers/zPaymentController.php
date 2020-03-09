<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\zPawnedItem;
use App\zPayments;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class zPaymentController extends Controller
{

    public function sendRenewPayment(Request $request)
    {
        DB::transaction(function () use ($request) {
            $id = $request->pawned_item_id;
            $pawned = zPawnedItem::find($id);
            $pawned->date_renew =  Carbon::now('Asia/Manila');
            $pawned->save();

            $payment = new zPayments;
            $payment->item_id = $pawned->item_id;
            $payment->pawned_item_id = $pawned->id;
            // 1 is claimed, 2 is renew
            $payment->payment_type = 2;
            $payment->payment_type_desc = 'renew';
            $payment->amount = $request->amount;
            $payment->save();
        });
    }

    public function sendClaimPayment(Request $request)
    {
        DB::transaction(function () use ($request) {
            $id = $request->pawned_item_id;
            $pawned = zPawnedItem::find($id);
            $pawned->date_claimed =  Carbon::now('Asia/Manila');
            $pawned->is_claimed = 1;
            $pawned->save();

            $payment = new zPayments;
            $payment->item_id = $pawned->item_id;
            $payment->pawned_item_id = $pawned->id;
            // 1 is claim, 2 is renew
            $payment->payment_type = 1;
            $payment->payment_type_desc = 'claim';
            $payment->amount = $request->amount;
            $payment->save();
        });
    }

    public function getPaymentHistory($pawned_id)
    {
        $pawned =  zPayments::all()->where('pawned_item_id', $pawned_id);
        return response()->json($pawned);
    }
}
