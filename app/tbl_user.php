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

    public function pawnshop_reports()
    {
        return $this->hasMany('App\tbl_user_report', 'pawnshopId', 'user_id');
    }

    public function pawnshop_notifications()
    {
        return $this->hasMany('App\zNotification', 'pawnshop_id', 'user_id');
    }

    public function packages()
    {
        return $this->hasMany('App\zPackage', 'pawnshop_id', 'user_id');
    }

}
