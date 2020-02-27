<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $primaryKey  = 'category_id';
    protected $table = 'tbl_item_category';

}
