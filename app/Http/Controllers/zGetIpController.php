<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;

class zGetIpController extends Controller
{
   public function getIp()
   {


      // this is staging
      $ip = Request::ip();
      return $ip;
      // Route::get('/getIp','GetIpController@getIp');;

   }

   // public function getClientIps()
   // {
   //    $clientIps = array();
   //    $ip = $this->server->get('REMOTE_ADDR');
   //    if (!$this->isFromTrustedProxy()) {
   //       return array($ip);
   //    }
   //    if (self::$trustedHeaders[self::HEADER_FORWARDED] && $this->headers->has(self::$trustedHeaders[self::HEADER_FORWARDED])) {
   //       $forwardedHeader = $this->headers->get(self::$trustedHeaders[self::HEADER_FORWARDED]);
   //       preg_match_all('{(for)=("?\[?)([a-z0-9\.:_\-/]*)}', $forwardedHeader, $matches);
   //       $clientIps = $matches[3];
   //    } elseif (self::$trustedHeaders[self::HEADER_CLIENT_IP] && $this->headers->has(self::$trustedHeaders[self::HEADER_CLIENT_IP])) {
   //       $clientIps = array_map('trim', explode(',', $this->headers->get(self::$trustedHeaders[self::HEADER_CLIENT_IP])));
   //    }
   //    $clientIps[] = $ip; // Complete the IP chain with the IP the request actually came from
   //    $ip = $clientIps[0]; // Fallback to this when the client IP falls into the range of trusted proxies
   //    foreach ($clientIps as $key => $clientIp) {
   //       // Remove port (unfortunately, it does happen)
   //       if (preg_match('{((?:\d+\.){3}\d+)\:\d+}', $clientIp, $match)) {
   //          $clientIps[$key] = $clientIp = $match[1];
   //       }
   //       if (IpUtils::checkIp($clientIp, self::$trustedProxies)) {
   //          unset($clientIps[$key]);
   //       }
   //    }
   //    // Now the IP chain contains only untrusted proxies and the client IP
   //    return $clientIps ? array_reverse($clientIps) : array($ip);
   // }


   public function getClientIps()
   {
      // return $this->getIp(); // the above method
      foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
         if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
               $ip = trim($ip); // just to be safe
               if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                  return $ip;
               }
            }
         }
      }
   }

   public function getClientIps2()
   {
      $ipaddress = '';
      if (isset($_SERVER['HTTP_CLIENT_IP']))
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      else if (isset($_SERVER['HTTP_X_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      else if (isset($_SERVER['HTTP_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
      else if (isset($_SERVER['REMOTE_ADDR']))
         $ipaddress = $_SERVER['REMOTE_ADDR'];
      else
         $ipaddress = 'UNKNOWN';
      return $ipaddress;
   }
}
