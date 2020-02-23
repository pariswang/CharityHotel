<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HotelHospital extends Model
{
    
    protected $table = 'wh_hotel_hospital';
	// protected $guarded = ['region'];
    protected $fillable = ['hotel_id','hospital_id','distance'];

    public $timestamps = false;
}
