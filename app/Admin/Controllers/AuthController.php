<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{

	public function register(){
		$username = 'joyoustar1';
		$name = 'simon1';
		$password = '123456';
		$res = createHoteler(compact("username","name","password"));
		echo($res);
		
	}
}
