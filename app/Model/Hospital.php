<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'wh_hospital';

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function nearbyHotels()
    {
        return $this->belongsToMany(Hotel::class, 'wh_hotel_hospital', 'hospital_id', 'hotel_id')->withPivot('distance');
    }

    public function nearbyApply()
    {
        return $this->belongsToMany(Subscribe::class, 'wh_subscribe_hospital', 'hospital_id', 'subscribe_id')->withPivot('distance', 'region_id');
    }
}
