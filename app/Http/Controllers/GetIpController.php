<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;

class GetIpController extends Controller
{
   public function getIp(){
<<<<<<< HEAD
      // this is staging
      $ip = Request::ip();
      dd($ip);
   

      
      // Route::get('/getIp','GetIpController@getIp');;
=======
      $ip = Request::ip();
      dd($ip);
>>>>>>> lim_development
   }
}
