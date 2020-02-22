<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'wh_hospital';

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function nearbyHotels()
    {
        return $this->belongsToMany(Hotel::class, 'wh_hotel_hospital', 'hospital_id', 'hotel_id')->withPivot('distance');
    }
}
