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
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $phone = $request->input($this->username());
        $tmpUser = User::where('phone', $phone)->first();
        if($tmpUser && $tmpUser->role == 3){
            throw ValidationException::withMessages([
                $this->username() => ['此账号是酒店人员，请在酒店入口登录！'],
            ]);
        }

        if($tmpUser && $tmpUser->state == 2){
            throw ValidationException::withMessages([
                $this->username() => ['此账号已被禁用，请联系管理员！'],
            ]);
        }

        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $redirectUrl = '/hotel_list';
        if($user->role == 3){
            $redirectUrl = '/apply_list';
        }

        $url = session('url.intended');
        if($url){
            session()->forget('url.intended');
            $redirectUrl = $url;
        }

        return [
            'success' => 1,
            'data' => ['url' => $redirectUrl],
        ];
    }
}
