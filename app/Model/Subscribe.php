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

class Subscribe extends Model
{
    protected $table = 'wh_subscribe';

    protected $fillable = [
        'user_id', 'conn_person', 'conn_phone', 'checkin_num', 'date_begin', 'date_end', 'createdate', 'hotel_id', 'conn_position', 'conn_company', 'room_count', 'can_pay', 'has_letter', 'status', 'admin_id', 'region_id','hoteltaking_date','hide_status'
    ];

    public $timestamps = false;

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

	public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nearbyHospitals()
    {
        return $this->belongsToMany(Hospital::class, 'wh_subscribe_hospital', 'subscribe_id', 'hospital_id')->withPivot('distance', 'region_id');
    }
}
