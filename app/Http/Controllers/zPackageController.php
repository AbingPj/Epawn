<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_package_duration;
use App\tbl_pawnshop_package;

class zPackageController extends Controller
{
        //added by abing
        public function viewPawnshopCategories2(Request $request){
                $categories = DB::table('tbl_pawnshop_itemcategory')
                ->join('tbl_item_category','tbl_item_category.category_id','=','tbl_pawnshop_itemcategory.category_id')
                ->where('pawnshop_id', $request->pawnshop_id)
                ->where('valid','1')
                ->get();
                return $categories;
        }

        public function getPawnshopPackages2(Request $request){
                $packages = tbl_pawnshop_package::all()->where('pawnshop_id', $request->pawnshopId);
                foreach ($packages as $key => $package) {
                    $packages->package_durations = $package->package_durations;
                }
                return response()->json($packages);
        }


        public function addPackageToPawnshop(Request $request){
                $data  = request()->validate([
                    'pawnshop_id' => 'required',
                    'package_name' => 'required|min:3',
                    'package_description' => 'required|min:3',
                ]);
                $package = new tbl_pawnshop_package;
                $package->package_name = $request->package_name;
                $package->pawnshop_id = $request->pawnshop_id;
                $package->package_description = $request->package_description;
                $package->save();
            
                $durations = $request->duration;
        
                foreach ($durations as $key => $duration) {
                    $package_duration = new tbl_package_duration;
                    $package_duration->package_id =  $package->package_id;
                    $package_duration->duration_from = $duration['duration_from'];
                    $package_duration->duration_to = $duration['duration_to'];
                    $package_duration->interestRate = $duration['interestRate'];
                    $package_duration->save();
                }
        }
        public function editPackageOfPawnshop(Request $request){

                $data  = request()->validate([
                    'package_id' => 'required',
                    'package_name' => 'required|min:3',
                    'package_description' => 'required|min:3',
                ]);

                $package_id = $request->package_id;
                $package = tbl_pawnshop_package::all()->where('package_id', $package_id)->first();
                $package->package_name = $request->package_name;
                $package->package_description = $request->package_description;
                $package->save();
                tbl_package_duration::where('package_id', $package_id)->delete();
                $durations = $request->duration;
                foreach ($durations as $key => $duration) {
                    $package_duration = new tbl_package_duration;
                    $package_duration->package_id =  $package_id;
                    $package_duration->duration_from = $duration['duration_from'];
                    $package_duration->duration_to = $duration['duration_to'];
                    $package_duration->interestRate = $duration['interestRate'];
                    $package_duration->save();
                }
        }
}
