<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Time: 8:56 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function list(Request $request)
    {
        echo 'apply list';
    }

    public function apply_hotel(Request $request)
    {
        echo 'apply hotel';
    }

    public function apply(Request $request)
    {
        echo 'apply';
    }
}