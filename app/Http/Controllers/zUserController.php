<?php

namespace App\Http\Controllers;

use App\tbl_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class zUserController extends Controller
{
    public function getUserInfo($id){
        $user = tbl_user::find($id);
        return response()->json($user);
    }

    public function getPawnshopInfo($id)
    {



        $user = tbl_user::find($id);

        if($user->role_id == 2){
            $dateNow =  Carbon::now('Asia/Manila');
            // $dateNow->addDays(32);
            $expirationDate = Carbon::parse($user->expiration);
            $expirationSub7days = Carbon::parse($user->expiration);
            $expirationSub7days->subDays(7);


            if ($dateNow <  $expirationDate) {
                $user->showWarning = 0;
                $user->dateNow = $dateNow;
                if ($dateNow >= $expirationSub7days) {
                    $user->showWarning = 1;
                    $user->dateNow = $dateNow;
                }
            } else {
                $user->isValid = 3;
                $user->save();
                $user->showWarning = 2;
                $user->dateNow = $dateNow;
            }
        }

       
        return response()->json($user);
    }

    public function changeProfile2(Request $request)
    {

        $uploadDir = "images/";

        $user = tbl_user::find($request->userId);
        $user->fname = $request->fname;
        $user->username = $request->fname;
        $user->address = $request->address;
        $user->control_num = $request->control_num;
        $user->contact = $request->contact;
        $user->monthCofescation = $request->confiscated;

        if ($request->file('permit') !== null) {
            $imagePermit = $request->file('permit');
            $imagePermitSanitizedName = time() . $imagePermit->getClientOriginalName();
            $imagePermit->move($uploadDir, $imagePermitSanitizedName);
            $user->business_permit = $imagePermitSanitizedName;
        }

        if ($request->file('profile') !== null) {
            $imageProfile = $request->file('profile');
            $imageProfileSanitizedName = time() . $imageProfile->getClientOriginalName();
            $imageProfile->move($uploadDir, $imageProfileSanitizedName);
            $user->image = $imageProfileSanitizedName;
        }

        $user->save();
        
        // return DB::table('tbl_users')
        //     ->where('user_id', '=', $request->userId)
        //     ->update([
        //         'fname' => $request->fname,
        //         'address' => $request->address,
        //         'control_num' => $request->control_num,
        //         'business_permit' => $imagePermitSanitizedName,
        //         'contact' => $request->contact,
        //         'image' => $imageProfileSanitizedName,
        //         'monthCofescation' =>  $request->confiscated
        //     ]);
    }


}
