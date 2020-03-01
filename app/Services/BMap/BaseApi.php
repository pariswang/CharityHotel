<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/29
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

namespace App\Services\BMap;

use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\build_query;

class BaseApi
{
    protected $schema = 'http';
    protected $domain = 'api.map.baidu.com';
    protected $http = null;

    public function __construct()
    {
        $this->http = new Client();
    }

    protected function api($path, $query)
    {
//        $ak = config('bmap.ak');
        $query['ak'] = config('bmap.ak');
        $query['timestamp'] = time();

        $url = $this->schema . '://' . $this->domain . $path;

        $sn = $this->sn($path, $query);
        $query['sn'] = $sn;

        $url .= '?' . http_build_query($query);
        return $this->get($url);
    }

    protected function sn($path, $querystring_arrays, $method = 'GET')
    {
        $sk = config('bmap.sk');
        if ($method === 'POST'){
            ksort($querystring_arrays);
        }
        $querystring = http_build_query($querystring_arrays);
        return md5(urlencode($path.'?'.$querystring.$sk));
    }

    protected function get($url)
    {
        $response = $this->http->request('GET', $url);
        $status = $response->getStatusCode();
        if(200 != $status){
            return false;
        }

        $string = (string)$response->getBody();
        return json_decode($string, true);
    }
}