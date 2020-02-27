<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_user extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $primaryKey  = 'user_id';

    public function reports()
    {
        return $this->hasMany('App\tbl_user_report', 'userId', 'user_id');
    }

}
