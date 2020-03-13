<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class zPackage extends Model
{
    public function durations()
    {
        // return $this->hasMany('App\zPackageDuration', 'package_id', 'id');
        return $this->hasMany('App\tbl_package_duration', 'package_id', 'id');
    }

    public function pawnshop()
    {
        return $this->belongsTo('App\tbl_user', 'pawnshop_id', 'user_id');
    }

}
