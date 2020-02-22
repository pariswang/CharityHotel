<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'wh_hotel';

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function nearbyHospitals()
    {
        return $this->belongsToMany(Hospital::class, 'wh_hotel_hospital', 'hotel_id', 'hospital_id')->withPivot('distance');
    }
}
//select `wh_hospital`.*, `wh_hotel_hospital`.`hospital_id` as `pivot_hospital_id`, `wh_hotel_hospital`.`hotel_id` as `pivot_hotel_id`, `wh_hotel_hospital`.`distance` as `pivot_distance` from `wh_hospital` inner join `wh_hotel_hospital` on `wh_hospital`.`id` = `wh_hotel_hospital`.`hotel_id` where `wh_hotel_hospital`.`hospital_id` = 1