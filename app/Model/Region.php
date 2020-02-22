<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'wh_region';

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
}
