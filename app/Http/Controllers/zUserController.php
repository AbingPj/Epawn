<?php

namespace App\Http\Controllers;

use App\tbl_user;
use Illuminate\Http\Request;

class zUserController extends Controller
{
    public function getUserInfo($id){

        $user = tbl_user::find($id);
        
        return response()->json($user);
    }
}
