<?php

namespace App\Http\Controllers;

use App\PawnshopItemCategory;
use Illuminate\Http\Request;

class zCategoriesController extends Controller
{
    public function getCategoriesByPawnshop($id){
        $categories =  PawnshopItemCategory::all()->where('pawnshop_id',$id);
        foreach ($categories as $key => $category) {
            $category->category_name = $category->category->category_name;
        }

        return response()->json($categories);
    }
}
