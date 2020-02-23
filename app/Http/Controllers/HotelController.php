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
        $search = $request->input('s');
        $hospitalId = $request->input('hospital');
        $regionId = $request->input('region');

        if($search){
            $hotels = Hotel::where('address', 'like', "%$search%");
            if($regionId){
                $hotels = $hotels->where('region_id', $regionId);
            }
            $hotels = $hotels->get();
        }elseif($regionId){
            $hotels = Hotel::where('region_id', $regionId)->get();
        }else{
            $hotels = Hotel::all();
        }

        if($hospitalId) {
            $hospital = Hospital::find($hospitalId);
            if($hospital) {
                $hospitalNearbyHotels = $hospital->nearbyHotels()->get(['hotel_id']);
                $ids = $hospitalNearbyHotels->map(function ($item) {
                    return $item->hotel_id;
                });
                $priorities = $hotels->filter(function ($item) use ($ids) {
                    return in_array($item->id, $ids->toArray());
                });
                $others = $hotels->diff($priorities);
                $hotels = $priorities->merge($others);
            }
        }

        // 选项
        $regions = Region::all();
        $hospitals = Hospital::all();
        $hospitals = $hospitals->map(function ($hospital){
            $hospital = $hospital->toArray();
            $hospital['id'] = (string) $hospital['id'];
            return $hospital;
        });

        return view('hotel.list', compact('hotels', 'regions', 'hospitals'));
    }
}