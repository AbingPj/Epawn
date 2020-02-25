<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ItemPost extends Controller
{
    public function getItemPosts(Request $request)
    {
        return DB::table('tbl_user_itempost')
           
            ->join('tbl_pawnshop_itemcategory','tbl_pawnshop_itemcategory.category_id','=','tbl_user_itempost.category_id')
            ->where('tbl_user_itempost.isExpired','1')
            ->where('tbl_pawnshop_itemcategory.pawnshop_id',
             $request->pawnshopId)
            ->where('tbl_user_itempost.status','0')
            ->get();
    }
    public function getUserItem(Request $request){
        return DB::table('tbl_user_itempost')
        ->join('tbl_item_category','tbl_item_category.category_id','=','tbl_user_itempost.category_id')
        ->where('user_id', $request->userId)
        ->get();
    }
    public function getUserItemPhotos(Request $request){
        return DB::table('tbl_item_photo')
        ->where('item_id', $request->itemId)
        ->get();
    }
      public function allItemPhotos(){
        return DB::table('tbl_item_photo')
        ->get();
    }
    public function uploadPhotoData(Request $request){
         $uploadDir = "images/";
        DB::table('tbl_item_photo')->insert(
        [
            'item_id' => $request->itemId,
            'item_photos' => $request->picture1
        ]);
          DB::table('tbl_item_photo')->insert(
        [
            'item_id' => $request->itemId,
            'item_photos' => $request->picture2
        ]);
          DB::table('tbl_item_photo')->insert(
        [
            'item_id' => $request->itemId,
            'item_photos' => $request->picture3
        ]);
          DB::table('tbl_item_photo')->insert(
        [
            'item_id' => $request->itemId,
            'item_photos' => $request->picture4
        ]);
    }
    public function uploadUserItemPhotos(Request $req){
         $uploadDir = "images/";
    
        if($req->file('ionicfile') != null){
            $mainPicture = $req->file('ionicfile');
            $imageMainPictureSanitizedName = $mainPicture->getClientOriginalName();
            $mainPicture->move($uploadDir, $imageMainPictureSanitizedName); 
        }else{
            $imageMainPictureSanitizedName = 'no-image.png';
        } 
    }
    public function getSingleItem($id)
    {
       return DB::table('tbl_user_itempost')
            ->leftJoin('tbl_item_photo', 'tbl_item_photo.item_id', '=', 'tbl_user_itempost.item_id')
            ->join('tbl_item_category','tbl_item_category.category_id','=','tbl_user_itempost.category_id')
            ->select('tbl_item_photo.*', 'tbl_user_itempost.*','tbl_item_category.*')
            ->where('tbl_user_itempost.item_id', '=', $id)->get();
       
    }
    public function getItemPictures($id){
        return DB::table('tbl_item_photo')
                ->where('tbl_item_photo.item_id','=',$id)
               ->get();
    }
    public function addItemPost(Request $req){
        

        DB::table('tbl_user_itempost')
        ->insert([
            'item_name' => $req->name,
            'item_description' => $req->description,
            'category_id' => $req->category,
            'user_id' => $req->userId,
            'item_photo' =>$req->imageName,
            'photo_1' =>$req->picture1,
            'photo_2' =>$req->picture2,
            'photo_3' =>$req->picture3,
            'photo_4' =>$req->picture4,
        ]);
        
    /*     DB::table('tbl_user_itempost')
        ->insert([
            'item_name' => $req->name,
            'item_description' => $req->description,
            'category_id' => $req->category_id,
            'user_id' => $req->userId,
            'item_photo' => $imageMainPictureSanitizedName
        ]); */

    }
    public function addItemPostImage(Request $req){
        $uploadDir = "images/";
    
        if($req->file('ionicfile') != null){
            $mainPicture = $req->file('ionicfile');
            $imageMainPictureSanitizedName = $mainPicture->getClientOriginalName();
            $mainPicture->move($uploadDir, $imageMainPictureSanitizedName); 
        }else{
            $imageMainPictureSanitizedName = 'no-image.png';
        } 
    }
    public function addOtherPhotos(Request $req){
         if($req->file('picture1') !== null){
            $picture1 = $req->file('picture1');
            $imagepicture1SanitizedName = time(). $picture1->getClientOriginalName();
            $picture1->move($uploadDir, $imagepicture1SanitizedName); 
        }else{
            $imagepicture1SanitizedName = 'no-image.png';
        }
    }
}
