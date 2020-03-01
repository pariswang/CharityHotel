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
        $keywords = $request->input('s');
        $hospitalId = $request->input('hospital');

        $search = (new Hotel())->newQuery();
        $search->where('status', '<>', 5);
        if($hospitalId){
            $search->where('hospital_ids', 'like', "%|$hospitalId|%");
        }elseif($regionId){
            $search->where('region_id', $regionId);
        }
        if($keywords){
            $search->where('search_keywords', 'like', "%$keywords%");
        }
        $search->orderBy('medical_price', 'asc')
            ->orderBy('discount_price', 'asc');
        $list = $search->get();
        // 有医护爱心价的
        $hasMedicalPrice = $list->filter(function ($hotel){
            return $hotel->medical_price > 0;
        });
        $list = $list->diff($hasMedicalPrice);
        // 没有非医护价格的
        $noDiscountPrice = $list->filter(function ($hotel){
            return $hotel->discount_price <= 0;
        });
        $list = $list->diff($noDiscountPrice)->sortBy('discount_price');
        return $hasMedicalPrice->merge($list)->merge($noDiscountPrice);
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