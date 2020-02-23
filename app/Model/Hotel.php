<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'wh_hotel';

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function nearbyHospitals()
    {
        return $this->belongsToMany(Hospital::class, 'wh_hotel_hospital', 'hotel_id', 'hospital_id')->withPivot('distance');
    }
}