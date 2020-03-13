<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_package_duration;
use App\zPackage;
use App\tbl_pawnshop_package;
use App\tbl_user;

class zPackageController extends Controller
{


    public function zGetPackages($pawnshop_id)
    {
        $packages = zPackage::all()->where('pawnshop_id', $pawnshop_id);
        foreach ($packages as $key => $pack) {
            $pack->durations = $pack->durations;
        }
        return $packages;
    }

    public function zSavePackage(Request $request)
    {

        DB::transaction(function () use ($request) {
            $pack = new zPackage;
            $pack->pawnshop_id = $request->pawnshop_id;
            $pack->package_name =  $request->package_name;
            $pack->package_description =  $request->package_desc;
            $pack->number_of_month =  $request->number_of_month;
            $pack->interest_per_month =  $request->interest_per_month;
            $pack->pinalty_per_month =  $request->pinalty_per_month;
            $pack->if_advance_interest =  $request->if_advance_interest;
            $count = count($request->durations);
            if ($count > 0) {
                $pack->if_has_special_offer = 1;
            } else {
                $pack->if_has_special_offer = 0;
            }
            $pack->save();
            foreach ($request->durations as $key => $duration) {
                // $dur = new zPackageDuration;
                $dur = new tbl_package_duration;
                $dur->package_id = $pack->id;
                $dur->duration_from = $duration['from'];
                $dur->duration_to = $duration['to'];
                $dur->interestRate = $duration['interest'];
                $dur->save();
            }
        });
    }

    public function package($id){
        $package = zPackage::find($id);
        $durations = $package->durations;
        return response()->json($package);
    }



    public function updatePackage(Request $request)
    {
        $id = $request->package_id;
        $package = zPackage::find($id);
        $package->package_name =  $request->package_name;
        $package->package_description =  $request->package_desc;
        $package->number_of_month =  $request->number_of_month;
        $package->interest_per_month =  $request->interest_per_month;
        $package->pinalty_per_month =  $request->pinalty_per_month;
        $package->if_advance_interest =  $request->if_advance_interest;

        $package->save();

        tbl_package_duration::where('package_id', $id)->delete();
        $durations = $request->durations;

        foreach ($durations as $key => $duration) {
            $package_duration = new tbl_package_duration;
            $package_duration->package_id =  $id;
            $package_duration->duration_from = $duration['duration_from'];
            $package_duration->duration_to = $duration['duration_to'];
            $package_duration->interestRate = $duration['interestRate'];
            $package_duration->save();
        }
    }

    public function removePackage($id)
    {
        tbl_package_duration::where('package_id', $id)->delete();
        zPackage::find($id)->delete();
    }




    public function viewPawnshopCategories2(Request $request)
    {
        $categories = DB::table('tbl_pawnshop_itemcategory')
            ->join('tbl_item_category', 'tbl_item_category.category_id', '=', 'tbl_pawnshop_itemcategory.category_id')
            ->where('pawnshop_id', $request->pawnshop_id)
            ->where('valid', '1')
            ->get();
        return $categories;
    }




    // public function getPawnshopPackages2(Request $request){
    //         $packages = tbl_pawnshop_package::all()->where('pawnshop_id', $request->pawnshopId);
    //         foreach ($packages as $key => $package) {
    //             $packages->package_durations = $package->package_durations;
    //         }
    //         return response()->json($packages);
    // }


    // public function addPackageToPawnshop(Request $request){
    //         $data  = request()->validate([
    //             'pawnshop_id' => 'required',
    //             'package_name' => 'required|min:3',
    //             'package_description' => 'required|min:3',
    //         ]);
    //         $package = new tbl_pawnshop_package;
    //         $package->package_name = $request->package_name;
    //         $package->pawnshop_id = $request->pawnshop_id;
    //         $package->package_description = $request->package_description;
    //         $package->save();  
    //         $durations = $request->duration;

    //         foreach ($durations as $key => $duration) {
    //             $package_duration = new tbl_package_duration;
    //             $package_duration->package_id =  $package->package_id;
    //             $package_duration->duration_from = $duration['duration_from'];
    //             $package_duration->duration_to = $duration['duration_to'];
    //             $package_duration->interestRate = $duration['interestRate'];
    //             $package_duration->save();
    //         }
    // }



    public function get_packages_of_pawnshop($pawnshop_id){

        $packages = tbl_user::find($pawnshop_id)->packages;
        foreach ($packages as $key => $value) {
            $value->durations = $value->durations;
        }
        return response()->json($packages);
    }

    public function get_package($package_id){
        $package = zPackage::find($package_id);
        $package->durations = $package->durations;
         return response()->json($package);
    }
    




}
