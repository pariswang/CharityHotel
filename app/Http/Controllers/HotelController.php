<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
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
        $hotels = $this->searchHotels($request);

        // 选项
        $regions = Region::with('hospitals')->get();
        $regions = $regions->map(function ($region){
            $regionArr = $region->toArray();
            $regionArr['hospitals'] = $region->hospitals->map(function ($hospital){
                $hospital = $hospital->toArray();
                $hospital['id'] = (string) $hospital['id'];
                return $hospital;
            })->toArray();
            return $regionArr;
        });

        $hospitals = Hospital::all();
        $hospitals = $hospitals->map(function ($hospital){
            $hospital = $hospital->toArray();
            $hospital['id'] = (string) $hospital['id'];
            return $hospital;
        })->sort(function ($v1, $v2){
            if(strpos($v1['hospital_name'], '方舱') !== false &&
                strpos($v2['hospital_name'], '方舱') === false){
                return false;
            }
            if(strpos($v1['hospital_name'], '方舱') === false &&
                strpos($v2['hospital_name'], '方舱') !== false){
                return true;
            }
            return $v1['id'] > $v2['id'];
        })->values();

        return view('hotel.list', compact('hotels', 'regions', 'hospitals'));
    }

    private function searchHotels($request)
    {
        $regionId = $request->input('distinct');
        $search = $request->input('s');
        $hospitalId = $request->input('hospital');
        if(empty($search) && empty($hospitalId) && empty($regionId)){
            return Hotel::where('status', '<>', Hotel::STATUS_DISABLE)->get();
        }

        $hotels = collect([]);

        if($search){
            $hotels = $this->keywordSearch($search);
        }

        if($hospitalId) {
            $hospital = Hospital::find($hospitalId);
            if($hospital) {
                $hospitalHotels = $hospital->nearbyHotels()->get();
                if($hotels->count()>0){
                    $hotels = $hotels->intersect($hospitalHotels);
                }else{
                    $hotels = $hospitalHotels;
                }
            }
        }elseif($regionId){
            $region = Region::find($regionId);
            if($region){
                $hotels = $region->hospitals;
            }
        }

        $hotels = $hotels->filter(function ($hotel){
            return $hotel->status != Hotel::STATUS_DISABLE;
        });
        return $hotels;
    }

    private function keywordSearch($keyword)
    {
        // 医院名称、酒店名称、酒店介绍
        $hospitalHotels = Hospital::with('nearbyHotels')
            ->where('hospital_name', 'like', "%$keyword%")
            ->get()
            ->map(function ($hospital){
                return $hospital->nearbyHotels;
            })->flatten();

        $hotels = Hotel::where('hotel_name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('address', 'like', "%$keyword%")
            ->get();
        return $hotels->merge($hospitalHotels);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $hotel = Hotel::find($id);
        if(!$hotel){
            return response()->redirectTo('/');
        }
        return view('hotel.detail', compact('hotel'));
    }
}