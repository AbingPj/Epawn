<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class zPawnedItem extends Model
{
    public function item()
    {
        return $this->belongsTo('App\tbl_user_itempost', 'item_id', 'item_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\tbl_user', 'customer_id', 'user_id');
    }
}
