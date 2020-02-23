<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use App\Traits\AdminHelper;

class AuthController extends BaseAuthController
{
    use AdminHelper;

	public function register(){
		$username = 'joyoustar1';
		$name = 'simon1';
		$password = '123456';
		$res = $this->createHoteler(compact("username","name","password"));
		echo($res);
		
	}
}
