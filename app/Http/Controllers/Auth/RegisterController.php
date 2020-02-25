<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

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
            'password' => 'required|string|min:6',
            'position' => 'required|string|max:150',
            'company' => 'required|string|max:150',
            'role' => 'required|string',
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
        // role: 2医护人员，3酒店人员，4志愿者

        $user = User::create([
            'uname' => $data['uname'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'position' => $data['position'],
            'company' => $data['company'],
            'role' => $data['role'],
            'create_date' => date('Y-m-d H:i:s'),
        ]);

        if(3 == $data['role']){
            createHoteler([
                'username' => $data['phone'],
                'name' => $data['uname'],
                'password' => Hash::make($data['password']),
            ]);
        }

        return $user;
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
        // 默认去酒店列表，去申请
        $defaultUrl = '/hotel_list';
        if($user->role == 3){
            $this->guard()->logout();
            // 如果是酒店人员，去申请列表
            $defaultUrl = '/apply_list';
        }

        // 如果之前有目的地
        $url = session('url.intended');
        if($url){
            session()->forget('url.intended');
            $defaultUrl = $url;
        }
        return [
            'success' => 1,
            'data' => ['url' => $defaultUrl],
        ];
    }

    public function showHotelRegistrationForm()
    {
        return view('auth.register',['hotel' => 1]);
    }
}
