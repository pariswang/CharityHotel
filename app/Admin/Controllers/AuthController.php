<?php

namespace App\Admin\Controllers;

use App\Model\User;
use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseAuthController
{

	public function register(){
		$username = 'joyoustar1';
		$name = 'simon1';
		$password = '123456';
		$res = createHoteler(compact("username","name","password"));
		echo($res);
		
	}

    /**
     * User logout.
     *
     * @return Redirect
     */
    public function getLogout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get a validator for an incoming login request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function loginValidator(array $data)
    {
        $phone = $data[$this->username()];
        $user = User::where('phone', $phone)->first();
        if($user && $user->state == 2){
            throw ValidationException::withMessages([
                $this->username() => ['此账号已被禁用，请联系管理员！'],
            ]);
        }

        return Validator::make($data, [
            $this->username()   => 'required',
            'password'          => 'required',
        ]);
    }
}
