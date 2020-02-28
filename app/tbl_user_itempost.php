<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_user_itempost extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $primaryKey  = 'item_id';
    protected $table = 'tbl_user_itempost';
}
