<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserDetails($userId){
        return DB::table('tbl_users')->where('user_id','=',$userId)->get();
    }
    public function loginUser(Request $request){
        return DB::table('tbl_users')
        ->where('email','=',$request->username)
        ->where('password','=', $request->password)
        ->get();
    }
    public function saveProfileImage(Request $request){
         $uploadDir = "images/";
        if($request->file('profile') !== null){
            $imageProfile = $request->file('profile');
            $imageProfileSanitizedName =  $imageProfile->getClientOriginalName();
            $imageProfile->move($uploadDir, $imageProfileSanitizedName); 
        }else{
            $imageProfileSanitizedName = 'no-profile.png';
        }
    }
    public function changeProfile(Request $request){

       

        return DB::table('tbl_users')
        ->where('user_id','=',$request->userId)
        ->update([
            'fname' => $request->fname,
            'address' => $request->address,
            'control_num' => $request->control_num,
            'business_permit' => $imagePermitSanitizedName,
            'contact' => $request->contact,
            'image' => $request->profile,
            'monthCofescation' =>  $request->confiscated
        ]);
    }

    public function changeUserProfile(Request $request){

        $uploadDir = "images/";

        if($request->file('profile') !== null){
            $imagePermit = $request->file('profile');
            $imagePorifleSanitizedName = time(). $imagePermit->getClientOriginalName();
            $imagePermit->move($uploadDir, $imagePorifleSanitizedName); 
        }else{
            $imagePorifleSanitizedName = 'no-image.png';
        }

        return DB::table('tbl_users')
        ->where('user_id','=',$request->userId)
        ->update([
            'fname' => $request->fname,
            'address' => $request->address,
            'email' => $request->email,
            'contact' => $request->contact,
            'image' => $request->profile
        ]);
    }

    public function addUser(Request $request){
        DB::table('tbl_users')->insert([
            'fname' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
            'username' => $request->email,
            'latitude' => $request->lat,
            'longtitude' => $request->long,
            'role_id' => '3'
        ]);
    }
    public function addStore(Request $request){

            $uploadDir = "images/";
            $image = $request->file('permit');
            $imageSanitizedName = time(). $image->getClientOriginalName();
            $image->move($uploadDir, $imageSanitizedName); 
        

        DB::table('tbl_users')->insert([
            'fname' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'contact' => $request->contact,
            'username' => $request->username,
            'control_num' => $request->control,
            'business_permit' => $imageSanitizedName,
            'latitude' => $request->lat,
            'longtitude' => $request->long,
            'address' => $request->address,
            'role_id' => '2'
        ]);
        

    }
    public function getPendingUsers(Request $request){
       return DB::table('tbl_users')
       ->where('isValid',$request->status)
       ->where('role_id','2')->get();
    }

    public function updateSatus(Request $request){
        return DB::table('tbl_users')
        ->where('user_id',$request->userId)
        ->update([
            'isValid' => $request->status,
            'noticed' => date("Y-m-d H:i:s"),
            'reason' => $request->reason]);
    
     }
    public function changePassword(Request $request){
        DB::table('tbl_users')
        ->where('user_id', $request->userId)
        ->update([
            'password' => $request->password
        ]);
    }
}
