<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/hospital_region', function (Request $request) {
    return \App\Model\Hospital::where('region_id',$request->input('q'))->get(['id', 'hospital_name as text'])->map(function ($hospital){
        $hospital = $hospital->toArray();
        $hospital['id'] = (string) $hospital['id'];
        return $hospital;
    })->sort(function ($v1, $v2){
        if(strpos($v1['text'], '方舱') !== false &&
            strpos($v2['text'], '方舱') === false){
            return false;
        }
        if(strpos($v1['text'], '方舱') === false &&
            strpos($v2['text'], '方舱') !== false){
            return true;
        }
        return $v1['id'] > $v2['id'];
    })->values();
});
Route::get('/hotel_region', function (Request $request) {
    return \App\Model\Hotel::where('region_id',$request->input('q'))->get(['id', 'hotel_name as text'])->values();
});
