<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Time: 8:56 PM
 */

namespace App\Http\Controllers;

use App\Model\Hotel;
use App\Model\Subscribe;
use App\Model\Region;
use App\Model\Hospital;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->input('s');
        $hospitalId = $request->input('hospital');
        $regionId = $request->input('distinct');
        $status = $request->input('status');

        $where = [];
        if($regionId){
            $where['region_id'] = $regionId;
        }
        if($status){
            $where['status'] = $status;
        }
        if($search){
//            $where['hope_addr'] = $search;
        }
        if($hospitalId){
//            $where['hospital_id'] = $hospitalId;
        }

        if(!empty($where)){
            $applies = null;
            foreach($where as $key => $value){
                if(null == $applies){
                    $applies = Subscribe::where($key, $value);
                }else{
                    $applies = $applies->where($key, $value);
                }
            }
            if($search){
                $applies = $applies->where('hope_addr', 'like', "%$search%");
            }
            $applies = $applies->get();
        }elseif($search) {
            $applies = Subscribe::where('hope_addr', 'like', "%$search%")->get();
        }else{
            $applies = Subscribe::all();
        }

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
        });

        return view('apply.list', compact('applies', 'regions', 'hospitals'));
    }

    public function apply_hotel(Request $request)
    {
        $id = $request->input('id');
        if(!$id){
            return response()->redirectTo('/apply');
        }

        $hotel = Hotel::find($id);
        $user = $request->user();

        return view('apply.hotel', compact('hotel', 'user'));
    }

    public function apply_hotel_submit(Request $request)
    {
        $user = $request->user();
        $data = $request->only(['conn_person', 'conn_phone', 'conn_position', 'conn_company', 'checkin_num', 'room_count', 'date_begin', 'date_end', 'can_pay', 'has_letter', 'hotel_id','region_id', 'hope_addr', 'remark']);
        $data['can_pay'] = $data['can_pay'] ? 1 : 0;
        $data['has_letter'] = $data['has_letter'] ? 1 : 0;
        $data['user_id'] = $user->id;
        $data['checked'] = 0;
        $data['createdate'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        if(isset($data['hotel_id']) && $hotel = \App\Model\Hotel::find($data['hotel_id'])){
            $data['admin_id'] = $hotel->user_id;
            if(!isset($data['region_id'])){
                $data['region_id'] = $hotel->region->id;
            }
        }
        $sub = Subscribe::create($data);
        if($sub){
            return [
                'success' => 1,
                'data' => [],
            ];
        }
    }

    public function apply(Request $request)
    {
        $regions = Region::all();
        $user = $request->user();
        return view('apply.open', compact('user', 'regions'));
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $apply = Subscribe::find($id);
        if(empty($apply)){
            return response()->redirectTo('/');
        }

        return view('apply.detail', compact('apply'));
    }
}
