<?php

namespace Webkul\Admin\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;

class KiotVietService
{
    protected $retailer;
    /**
     * Create a new webhook service instance.
     */
    public function __construct()
    {
        $this->retailer = 'pck';
    }

    public function getCustomerFromKiotViet($page = 1, $size = 100) 
    {
        $client = new Client;
        try {
            $headers = [
                'Retailer' => 'pkc',
                'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6ImF0K2p3dCJ9.eyJuYmYiOjE3MzUzNjkxNjksImV4cCI6MTczNTQ1NTU2OSwiaXNzIjoiaHR0cDovL2lkLmtpb3R2aWV0LnZuIiwiY2xpZW50X2lkIjoiMDU5NGExMmEtNWRhOC00M2ZmLWFiZGQtYTIxZjMyZDY2N2ZhIiwiY2xpZW50X1JldGFpbGVyQ29kZSI6InBrYyIsImNsaWVudF9SZXRhaWxlcklkIjoiNjk2NzQwIiwiY2xpZW50X1VzZXJJZCI6IjEyODk4NyIsImNsaWVudF9TZW5zaXRpdmVBcGkiOiJUcnVlIiwiY2xpZW50X0dyb3VwSWQiOiIyNCIsImlhdCI6MTczNTM2OTE2OSwic2NvcGUiOlsiUHVibGljQXBpLkFjY2VzcyJdfQ.e_5BL0Ci-75_AbHR6BICxsgrQ4REWD1TbxERQKB55dFl4MlR2BRN9svRcivqhrhIJHhVUqBPJl4YuKMtZxOaDMqTetkNmUd2-N6-H_zMHVVS3qf1PzP2RZRfkwc6X_o7AGVvCWHrtDOS4C61f9K72MiwZ6qHvkuaKZd30bMVu-GvXKmVFcByiIDVAqecmTRgARtwWdebrFcMpgOb5fd-gD5V4TbkW-6eJXcU2oKaY6yJ2hxFtl7IhEWL-kkqh_mH8BlRlWIOK4tviyA4m1WmT105mYdmbXAO7d7lvvTAzFMWnDAYpA20vpY2gq0j0_GICYgoBgDUdb2zLGKumYYZig',
            ];
            $request = new Request('GET', "https://public.kiotapi.com/customers?pageSize={$size}&includeTotal=true&includeCustomerGroup=true&includeCustomerSocial=true&currentItem={$page}&orderBy=createdDate", $headers);
            $res = $client->sendAsync($request)->wait();
            $response = json_decode($res->getBody()->getContents());
            return $response;
        } catch (\Exception $e) {
           dd($e);
        }
    }
}
