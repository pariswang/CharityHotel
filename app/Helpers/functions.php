<?php

/**
 * @Author: Simon Zhao
 * @Date:   2020-02-23 01:08:19
 * @Last Modified by:   Simon Zhao
 * @Last Modified time: 2020-02-23 16:30:56
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
	        $html .= "<p>".$value[0].":<strong>".(isset($value[1])&&$value[1]=='boolean'?($obj->$key?'是':'否'):$obj->$key)."</strong></p>";
	    }
	}
	return $html;
}