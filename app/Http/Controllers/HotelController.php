<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Time: 8:55 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Hotel;
use App\Model\Hospital;
use App\Model\Region;

class HotelController extends Controller
{
    public function list(Request $request)
    {
        $hotels = Hotel::all();
        $regions = Region::all();
        $hospitals = Hospital::all();

        return view('hotel.list', compact('hotels', 'regions', 'hospitals'));
    }
}