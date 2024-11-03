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
                'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6ImF0K2p3dCJ9.eyJuYmYiOjE3MzA2MTE3OTYsImV4cCI6MTczMDY5ODE5NiwiaXNzIjoiaHR0cDovL2lkLmtpb3R2aWV0LnZuIiwiY2xpZW50X2lkIjoiMDU5NGExMmEtNWRhOC00M2ZmLWFiZGQtYTIxZjMyZDY2N2ZhIiwiY2xpZW50X1JldGFpbGVyQ29kZSI6InBrYyIsImNsaWVudF9SZXRhaWxlcklkIjoiNjk2NzQwIiwiY2xpZW50X1VzZXJJZCI6IjEyODk4NyIsImNsaWVudF9TZW5zaXRpdmVBcGkiOiJUcnVlIiwiY2xpZW50X0dyb3VwSWQiOiIyNCIsImlhdCI6MTczMDYxMTc5Niwic2NvcGUiOlsiUHVibGljQXBpLkFjY2VzcyJdfQ.yEF9uY5HwTyU5SdEgZcZLXBvYEJokfp07PlKr8bTxsbC1fG3PDMreLVnUFe9_IUY2v41qM_rSBun0QZKoMOweQenyKczNMHkVbbh5fhePgKDKFNB-m7U5TMK-Rglwz271xXCib7qH68NAoNDE4vjY6MlzmP0W7tcdp06Li3xOBnXOuAXf5QhkAA-ckOiOt69xLHT6hW1mUZiHjvzkFYR_N5h8JILuLIV1A90N5XbpBSidG4GKwd3zAEdjkaxhFrcxrrZBiKyyVjZ9ePhSj_87KgOUyeb7gX35nfl2P4arMJVRlxGA_fNhPeTB1vwcBC2BNSQwVsJ9WPEiJwlTny58Q',
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
