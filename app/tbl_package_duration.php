<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_package_duration extends Model
{

    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'tbl_package_duration';

    public function package()
    {
        return $this->belongsTo('App\tbl_pawnshop_package', 'package_id','package_id');
    }
}
