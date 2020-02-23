<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Time: 8:56 PM
 */

namespace App\Http\Controllers;

use App\Model\Hotel;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function list(Request $request)
    {
        echo 'apply list';
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
        $data = $request->only(['conn_person', 'conn_phone', 'conn_position', 'conn_company', 'checkin_num', 'room_count', 'date_begin', 'date_end', 'can_pay', 'has_letter', 'hotel_id']);
        $data['user_id'] = $user->id;
        $data['checked'] = 0;
        $data['createdate'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
    }

    public function apply(Request $request)
    {
        return view('apply.open');
    }
}
