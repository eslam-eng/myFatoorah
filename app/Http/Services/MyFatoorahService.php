<?php

namespace App\Http\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
class MyFatoorahService
{
    private $base_url,$header,$client_request ;

    public function __construct(Client $request_client)
    {
        $this->client_request = $request_client;
        $this->base_url = env('FATOORAH_BASE_URL');
        $this->header = [
            'Content-Type'=>'application/json',
            'Authorization'=>'Bearer '.env('MYFATOORAH_TOKEN')
        ];
    }


    public function buildRequest($method,$url,$body=[])
    {
        $request = new Request('post',$this->base_url.$url,$this->header);

        if (!$body)
            return false ;

        $response = $this->client_request->send($request,[
            'json'=>$body
        ]);

        if ($response->getStatusCode()!=200)
            return false;
        return  json_decode($response->getBody(),true);


    }

    public function sendPayment($data)
    {

        $response = $this->buildRequest('POST','/v2/SendPayment',$data);
        return $response;

    }
}
