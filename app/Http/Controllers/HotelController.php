<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Time: 8:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function list(Request $request)
    {
        $hotels = Hotel::all();
        return view('hotel.list', compact('hotels'));
    }
}