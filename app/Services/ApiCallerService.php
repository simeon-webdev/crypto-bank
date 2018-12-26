<?php

namespace App\Service;

use GuzzleHttp\Client;

class ApiCallerService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($url = null)
    {
        try {

            $response = $this->client->request('GET', $url, [
                'query' => [
                    'access_key' => env('API_CALLER_ACCESS_KEY')
                ]
            ]);

            return json_decode($response->getBody());
        } catch(\Exception $exception) {
            throw new $exception;
        }
    }
}
