<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class zPackage extends Model
{
    public function durations()
    {
        return $this->hasMany('App\zPackageDuration', 'package_id', 'id');
    }
}
