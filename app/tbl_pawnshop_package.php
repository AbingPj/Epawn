<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_pawnshop_package extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $primaryKey  = 'package_id';
    protected $table = 'tbl_pawnshop_package';


    public function package_durations()
    {
        return $this->hasMany('App\tbl_package_duration', 'package_id', 'package_id');
    }
}
