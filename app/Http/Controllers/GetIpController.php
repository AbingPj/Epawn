<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;

class GetIpController extends Controller
{
   public function getIp(){
      $ip = Request::ip();
      dd($ip);
   }
}
