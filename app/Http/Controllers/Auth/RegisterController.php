<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/hotel_list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required|string|unique:wh_user|max:13',
            'uname' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'position' => 'required|string|max:150',
            'company' => 'required|string|max:150',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Model\User
     */
    protected function create(array $data)
    {
        return User::create([
            'uname' => $data['uname'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'position' => $data['position'],
            'company' => $data['company'],
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $url = session('url.intended');
        if($url){
            session()->forget('url.intended');
            return response()->redirectTo($url);
        }
    }
}
