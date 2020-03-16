<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class zNotifiction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\tbl_user', 'user_id', 'user_id');
    }
    public function pawnshop()
    {
        return $this->belongsTo('App\tbl_user', 'pawnshop_id', 'user_id');
    }
}
