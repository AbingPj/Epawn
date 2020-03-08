<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PharIo\Manifest\Email;

class zEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function test()
    {

        


        $digits = 5;
        $confirmation_code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send(
            'emails.welcome',
            ['confirmation_code' => $confirmation_code],
            function ($message) {
                $message
                    ->from('epawn.online01@gmail.com', 'E-PAWN')
                    ->to('pj.abing@gmail.com', 'PJ Abing' )
                    ->subject('E-pawn Email Verification!');
            }
        );




        return "Email Sent";
    }
}
