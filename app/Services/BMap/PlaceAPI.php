<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/29
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

namespace App\Services\BMap;


class PlaceAPI extends BaseApi
{

    public function region($place)
    {
        $params = [
            'query' => $place,
            'region' => '武汉市',
            'output' => 'json',
            'city_limit' => 'true',
//            'scope' => 1,
//            'coord_type' => 3, // 百度坐标
            'page_size' => 20,

        ];
        $path = '/place/v2/search';

        $response = $this->api($path, $params);
        if($response['status'] != 0){
            return false;
        }

        return $response['results'];
    }
}