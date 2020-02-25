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

class Hotel extends Model
{
    protected $table = 'wh_hotel';

    public $timestamps = false;

    const STATUS_DISABLE = 5;
    const STATUS_ENABLE = 0;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function nearbyHospitals()
    {
        return $this->belongsToMany(Hospital::class, 'wh_hotel_hospital', 'hotel_id', 'hospital_id')->withPivot('distance');
    }

    public function hospitals()
    {
        return $this->hasMany(HotelHospital::class, 'hotel_id');
    }

    const DELIMITER = '|';

    public function keywords()
    {
        $hospitalNames = $this->nearbyHospitals()->pluck('hospital_name')->toArray();
        return implode(self::DELIMITER, array_merge([
            $this->hotel_name,
            $this->address,
            $this->description,
        ], $hospitalNames));
    }

    public function hospitalSearchString()
    {
        return self::DELIMITER . implode(self::DELIMITER, $this->hospitals()->pluck('hospital_id')->toArray()) . self::DELIMITER;
    }
}