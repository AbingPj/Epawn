<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_user_itempost extends Model
{

    public $primaryKey  = 'item_id';
    protected $table = 'tbl_user_itempost';
    protected $guarded = [];
    public $timestamps = false;
   
    public function user()
    {
        return $this->belongsTo('App\tbl_user', 'user_id', 'user_id');
    }
    public function category()
    {
        return $this->belongsTo('App\ItemCategory', 'category_id', 'category_id');
    }


}
