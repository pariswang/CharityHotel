<?php

/**
 * @Author: Simon Zhao
 * @Date:   2020-02-23 01:08:19
 * @Last Modified by:   Simon Zhao
 * @Last Modified time: 2020-02-25 22:34:00
 */

/**
 * [createHoteler 创建酒店管理人员]
 * @param  [type] $data [Array] ['usernmame,name,password']
 * @return [user object|string]       [用户模型或者错误描述]
 */
function createHoteler($data){
	$userModel = config('admin.database.users_model');
	try{
        $user = $userModel::create(collect($data)->only(['username','name','password'])->toArray());
    	$user->roles()->attach(2);
	}catch (\Exception $e) {
		switch ($e->getCode()) {
			case '23000':
				return "用户已存在";
				break;
			default:
				return $e->getMessage();
				break;
		}
    }
    return $user;
}

function htmlInOneField($fieldArr,$obj){
	$html = "";
	foreach ($fieldArr as $key => $value) {
	    if(isset($obj->$key)&&$value[0]){
	    	if(isset($value[1])){
	    		switch ($value[1]) {
	    			case 'boolean':
	        			$html .= "<p>".$value[0].":<strong>".($obj->$key?'是':'否')."</strong></p>";
	    				break;
	    			case 'longtext':
	        			$html .= "<p>".$value[0].":<br><strong>".$obj->$key."</strong></p>";;
	    				break;
	    			default:
	    				# code...
	    				break;
	    		}
	    	}else{
	        	$html .= "<p>".$value[0].":<strong>".$obj->$key."</strong></p>";

	    	}
	    }
	}
	return $html;
}
function checkAdminRole($role_slug){
	return count(array_intersect(is_string($role_slug)?[$role_slug]:$role_slug, \Encore\Admin\Facades\Admin::user()->roles->pluck('slug')->toArray()))?true:false;
}

function getStaticData($title){
	$userModel = config('admin.database.users_model');
	switch ($title) {
		case 'register_hotel_users':
			 $arr = [
			 	'today' => $userModel::whereHas('roles', function ($query) {
				    $query->where('admin_roles.slug','=','hotel_user');
				})->whereBetween('created_at',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->count(),
			 	'yesterday' => $userModel::whereHas('roles', function ($query) {
				    $query->where('admin_roles.slug','=','hotel_user');
				})->whereBetween('created_at',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->count(),
			 	'total' => $userModel::whereHas('roles', function ($query) {
				    $query->where('admin_roles.slug','=','hotel_user');
				})->count()
			];
			break;
		case 'register_doctors':
			 $arr = [
			 	'today' => \App\Model\User::where('role',2)->whereBetween('create_date',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->count(),
			 	'yesterday' => \App\Model\User::where('role',2)->whereBetween('create_date',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->count(),
			 	'total' => \App\Model\User::where('role',2)->count()
			];
			break;
		case 'put_hotels':
			 $arr = [
			 	'today' => \App\Model\Hotel::whereBetween('create_date',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->count(),
			 	'yesterday' => \App\Model\Hotel::whereBetween('create_date',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->count(),
			 	'total' => \App\Model\Hotel::count()
			];
			break;
		case 'put_hotels_rooms':
			 $arr = [
			 	'today' => \App\Model\Hotel::whereBetween('create_date',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->sum('room_count'),
			 	'yesterday' => \App\Model\Hotel::whereBetween('create_date',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->sum('room_count'),
			 	'total' => \App\Model\Hotel::sum('room_count')
			];
			break;
		case 'request_count':
			 $arr = [
			 	'today' => \App\Model\Subscribe::whereBetween('createdate',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->count(),
			 	'yesterday' => \App\Model\Subscribe::whereBetween('createdate',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->count(),
			 	'total' => \App\Model\Subscribe::count()
			];
			break;
		case 'request_taking_count':
			 $arr = [
			 	'today' => \App\Model\Subscribe::where('status',5)->whereBetween('createdate',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->count(),
			 	'yesterday' => \App\Model\Subscribe::where('status',5)->whereBetween('createdate',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->count(),
			 	'total' => \App\Model\Subscribe::where('status',5)->count()
			];
			break;
		case 'request_taking_rooms':
			 $arr = [
			 	'today' => \App\Model\Subscribe::where('status',5)->whereBetween('createdate',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->sum('room_count'),
			 	'yesterday' => \App\Model\Subscribe::where('status',5)->whereBetween('createdate',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->sum('room_count'),
			 	'total' => \App\Model\Subscribe::where('status',5)->sum('room_count')
			];
			break;
		case 'request_taking_users':
			 $arr = [
			 	'today' => \App\Model\Subscribe::where('status',5)->whereBetween('createdate',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->sum('checkin_num'),
			 	'yesterday' => \App\Model\Subscribe::where('status',5)->whereBetween('createdate',[date('Y-m-d 00:00:00',strtotime("-1 day")),date('Y-m-d 23:59:59',strtotime("-1 day"))])->sum('checkin_num'),
			 	'total' => \App\Model\Subscribe::where('status',5)->sum('checkin_num')
			];
			break;
		
		default:
			return false;
			break;
	}
	return array_merge(compact('title'),$arr);


}