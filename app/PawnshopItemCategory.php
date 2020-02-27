<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PawnshopItemCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'tbl_pawnshop_itemcategory';

    public function category()
    {
        return $this->belongsTo('App\ItemCategory', 'category_id', 'category_id');
    }

}
