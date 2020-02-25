<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HotelHospital extends Model
{
    
    protected $table = 'wh_hotel_hospital';
	// protected $guarded = ['region'];
    protected $fillable = ['hotel_id', 'region_id','hospital_id','distance'];

    public $timestamps = false;
}
