<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Time: 9:09 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        echo 'user register';
    }
}