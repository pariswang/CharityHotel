<?php

/**
 * @Author: Simon Zhao
 * @Date:   2020-02-23 01:08:19
 * @Last Modified by:   Simon Zhao
 * @Last Modified time: 2020-02-23 02:38:31
 */
namespace App\Traits;

trait AdminHelper
{
	protected function createHoteler($data){
		$userModel = config('admin.database.users_model');
        $user = $userModel::create(['username'=>$data['username'],'name'=>$data['name'],'password'=>bcrypt($data['password'])]);
        if($user){
        	$user->roles()->attach(2);
        }
        return $user;
	}

	
}