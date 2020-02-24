<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/24
 * Time: 4:21 PM
 */

namespace App\Http\Controllers;


use App\Model\Subscribe;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $applies = Subscribe::where('user_id', $user->id)->get();
        
        return view('profile.index', compact('user', 'applies'));
    }
}