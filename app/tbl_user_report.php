<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_user_report extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\tbl_user', 'userId','user_id');
    }

    
    public function pawnshop()
    {
        return $this->belongsTo('App\tbl_user', 'pawnshopId','user_id');
    }

}
