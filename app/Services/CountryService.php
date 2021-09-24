<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CountryService 
{
    public function fetch() {
        $url = 'https://api.first.org/data/v1/countries';

        // $response = Http::get($url, [
        //     'region' => 'Africa'
        // ]);
        // return Arr::get($response->json(),'data');

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url, [
            // 'auth' => ['user', 'pass']
            'query' => ['region' => 'Africa']
        ]);
        // echo $res->getStatusCode();
        // // "200"
        // echo $res->getHeader('content-type')[0];
        // 'application/json; charset=utf8'
        return $res->getBody();
    }
}