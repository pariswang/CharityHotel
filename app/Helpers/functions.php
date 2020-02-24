<?php

/**
 * @Author: Simon Zhao
 * @Date:   2020-02-23 01:08:19
 * @Last Modified by:   Simon Zhao
 * @Last Modified time: 2020-02-24 19:09:26
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
	return in_array($role_slug, \Encore\Admin\Facades\Admin::user()->roles->pluck('slug')->toArray());
}