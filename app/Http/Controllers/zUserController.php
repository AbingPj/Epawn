<?php

namespace App\Http\Controllers;

use App\tbl_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class zUserController extends Controller
{
    public function getUserInfo($id){

        $user = tbl_user::find($id);
        
        return response()->json($user);
    }

    public function changeProfile2(Request $request)
    {

        $uploadDir = "images/";

        if ($request->file('permit') !== null) {
            $imagePermit = $request->file('permit');
            $imagePermitSanitizedName = time() . $imagePermit->getClientOriginalName();
            $imagePermit->move($uploadDir, $imagePermitSanitizedName);
        } else {
            $imagePermitSanitizedName = 'no-image.png';
        }

        if ($request->file('profile') !== null) {
            $imageProfile = $request->file('profile');
            $imageProfileSanitizedName = time() . $imageProfile->getClientOriginalName();
            $imageProfile->move($uploadDir, $imageProfileSanitizedName);
        } else {
            $imageProfileSanitizedName = 'no-profile.png';
        }

        return DB::table('tbl_users')
            ->where('user_id', '=', $request->userId)
            ->update([
                'fname' => $request->fname,
                'address' => $request->address,
                'control_num' => $request->control_num,
                'business_permit' => $imagePermitSanitizedName,
                'contact' => $request->contact,
                'image' => $imageProfileSanitizedName,
                'monthCofescation' =>  $request->confiscated
            ]);
    }


}
