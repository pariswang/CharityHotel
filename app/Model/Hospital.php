<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'wh_hospital';
    
    public function region(){
        return $this->hasOne('App\Model\Region', 'id', 'region_id');
    }
}
