<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/26
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

namespace App\Events;


use App\Model\Hotel;

class HotelSaving
{
    public $hotel;

    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }
}