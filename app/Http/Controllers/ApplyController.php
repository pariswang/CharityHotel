<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

namespace App\Http\Controllers;

use App\Model\Hotel;
use App\Model\Subscribe;
use App\Model\Region;
use App\Model\Hospital;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApplyController extends Controller
{
    public function list(Request $request)
    {
        $applies = $this->searchList($request);

        list($regions, $hospitals) = $this->selectOptions();

        return view('apply.list', compact('applies', 'regions', 'hospitals'));
    }

    private function searchList($request)
    {
        $keyword = $request->input('s');
        $hospitalId = $request->input('hospital');
        $regionId = $request->input('distinct');
        $status = $request->input('status');

        $search = (new Subscribe())->newQuery();
        $search->where('status', '<>', 5);
        $search->where('hide_status', 0);
        if($hospitalId){
            $search->where('hospital_ids', 'like', "%|$hospitalId|%");
        }elseif($regionId){
            $search->where('region_id', $regionId);
        }
        if($keyword){
            $search->where('hope_addr', 'like', "%$keyword%");
        }
        return $search->orderBy('createdate', 'desc')->get();
    }

    private function searchKeyword($keyword)
    {

    }

    public function apply_hotel(Request $request)
    {
        $id = $request->input('id');
        if(!$id){
            return response()->redirectTo('/apply');
        }

        $hotel = Hotel::find($id);
        if(empty($hotel)){
            return response()->redirectTo('/apply');
        }
        $user = $request->user();

        list($regions, $hospitals) = $this->selectOptions();

        return view('apply.hotel', compact('hotel', 'user', 'regions', 'hospitals'));
    }

    public function apply_hotel_submit(Request $request)
    {
        $user = $request->user();
        $this->checkApplyFrequency($user);

        $data = $request->only(['conn_person', 'conn_phone', 'spare_phone', 'conn_position', 'conn_company', 'checkin_num', 'room_count', 'date_begin', 'date_end', 'can_pay', 'has_letter', 'hotel_id','region_id', 'hope_addr', 'remark']);
        $data['can_pay'] = $data['can_pay'] == 'true' ? 1 : 0;
        $data['has_letter'] = $data['has_letter'] == 'true' ? 1 : 0;
        $data['user_id'] = $user->id;
        $data['checked'] = 0;
        $data['createdate'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        if(isset($data['hotel_id']) && $hotel = \App\Model\Hotel::find($data['hotel_id'])){
            $data['admin_id'] = $hotel->user_id;
            if(!isset($data['region_id'])){
                $data['region_id'] = $hotel->region->id;
            }
        }else{
            $data['admin_id'] = 0;
        }

        $hospitals = $request->input('hospitals');
        $sub = Subscribe::create($data);
        if($sub){
            if(!empty($hospitals)){
                $sub->nearbyHospitals()->attach($this->savePivot($hospitals));
            }

            return [
                'success' => 1,
                'data' => [],
            ];
        }
    }

    // 编辑离店时间
    public function edit_end_date(Request $request)
    {
        $user = $request->user();
        $this->checkApplyFrequency($user);

        $data = $request->only(['id','date_end']);

        if ($data['id'] == '') {
            throw ValidationException::withMessages([
                'remark' => ['数据异常'],
            ]);
        }

        if ($data['date_end'] == '') {
            throw ValidationException::withMessages([
                'remark' => ['离店时间不可为空'],
            ]);
        }

        $old = Subscribe::find($data['id']);
        if($old->status != 1){
            throw ValidationException::withMessages([
                'remark' => ['申请单状态变更，无法修改信息'],
            ]);
        }
        $sub = Subscribe::where('id', $data['id'])->update(['date_end' => $data['date_end']]);
        if($sub){
            return [
                'success' => 1,
                'data' => [],
            ];
        }
    }

    private function checkApplyFrequency($user)
    {
        $last = Subscribe::where('user_id', $user->id)->orderBy('createdate', 'desc')->first();
        if($last){
            if( time() < strtotime($last->createdate) + 10*60 ){
                throw ValidationException::withMessages([
                    'remark' => ['每10分钟只允许提交一次！'],
                ]);
            }
        }
    }

    private function savePivot($hospitals)
    {
        $attaches = [];
        foreach($hospitals as $hospital){
            $attaches[$hospital['id']] = [
                'distance' => 0,
                'region_id' => $hospital['region_id'],
            ];
        }
        return $attaches;
    }
    public function apply(Request $request)
    {
        $user = $request->user();

        list($regions, $hospitals) = $this->selectOptions();

        return view('apply.open', compact('user', 'regions', 'hospitals'));
    }

    public function detail(Request $request)
    {
        $user = $request->user();
        $id = $request->input('id');
        $apply = Subscribe::find($id);
        if(empty($apply)){
            return response()->redirectTo('/');
        }

        return view('apply.detail', compact('apply', 'user'));
    }

    private function selectOptions()
    {
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

        return [$regions, $hospitals];
    }

    public function cancel(Request $request)
    {
        $user = $request->user();
        $id = $request->input('id');

        $apply = Subscribe::find($id);

        if($apply->user_id != $user->id){
            throw ValidationException::withMessages([
                'remark' => ['这不是您的申请单！'],
            ]);
        }

        $apply->delete();
        return [
            'success' => 1,
            'data' => [],
        ];
    }
}
