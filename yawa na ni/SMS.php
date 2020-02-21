<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;


class SMS extends Controller
{
    public function sendSMS(Request $request){
        $basic  = new \Nexmo\Client\Credentials\Basic('46bbfde1', '6eON0n0GZnQEEmvb');
        $client = new \Nexmo\Client($basic);

    
        if($request->isRange != false){
            $message = $request->pawnshop_name." has appraised P".$request->bidamount." on your item of ". $request->itemName;
        }else{
            $message = $request->pawnshop_name." has appraised from P".$request->bid_from. " up to P".$request->bid_to." on your item of ". $request->itemName;
        }
       $client->message()->send([
            'to' => '639507599270',
            'from' => 'Epawn',
            'text' => $message
        ]);

    //   $nexmo = app('Nexmo/Client');
    //   $nexmo->message()->send([
    //     'to'   => '14845551244',
    //     'from' => '16105552344',
    //     'text' => 'Using the instance to send a message.'
    //   ]);
    }
    public function dealClose(Request $request){
        $basic  = new \Nexmo\Client\Credentials\Basic('46bbfde1', '6eON0n0GZnQEEmvb');
        $client = new \Nexmo\Client($basic);
        $message = "Your item of ".$request->item_name." is in pending and is closed with the amount of "
        .$request->bid_price.", Please visit any ".$request->fname." branch. Open/Install Our mobile application 
        to view ". $request->fname."'s location";
     
       $client->message()->send([
            'to' => '639507599270',
            'from' => 'Epawn',
            'text' => $message
        ]);
    }
}
