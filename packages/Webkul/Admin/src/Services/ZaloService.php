<?php

namespace Webkul\Admin\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;
use Webkul\Lead\Models\ZaloConfig;

class ZaloService
{
    protected $appId;
    protected $secretKey;
    protected $accessToken;
    protected $refreshToken;
    protected $idZaloConfig;
    /**
     * Create a new webhook service instance.
     */
    public function __construct()
    {
        $this->appId = env('ZALO_APP_ID');
        $this->secretKey = env('ZALO_SECRET_KEY');
        $this->idZaloConfig = 1;
    }

    public function getConfig()
    {
        $config = ZaloConfig::where('id', $this->idZaloConfig)->first();
        var_dump(time() . '__' . $config->token_expired_at);
        var_dump(time() >= $config->token_expired_at);
        die();

        if (time() >= $config->token_expired_at) {

            $this->getAccessTokenByRefreshToken();

            $config = ZaloConfig::where('id', $this->idZaloConfig)->first();
        }

        return $config;
    }

    public function getAccessTokenByRefreshToken()
    {
        $config = $this->getConfig();
        $data = [
            'headers' => [
                'secret_key' => $this->secretKey,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'refresh_token' => $config->refresh_token,
                'app_id' => $this->appId,
                'grant_type' => "refresh_token",
            ]
        ];
        $client = new Client;
        $response = $client->request('POST', env('ZALO_URL_GET_TOKEN'), $data);
        $content = $response->getBody()->getContents();
        $content = json_decode($content);

        # lưu lại thông tin config vào db
        $this->zaloConfigRepository->update([
            'access_token' => $content->access_token,
            'refresh_token' => $content->refresh_token,
            'token_expired_at' => time() + $content->expires_in - 600, // trừ 600s tức là chủ động set lại thời gian hết hạn của token 
        ], $this->idZaloConfig);

        return true;
    }

    public function getTemplate()
    {
        $config = self::getConfig();
        $client = new Client;
        $data = (Object) [];

        try {
            $url = env('ZALO_URL_GET_TEMPLATE');
            $options = [
                'headers' => [
                    'Access_token' => $config->access_token
                ],
                'query' => [
                    'offset' => $config->offset,
                    'limit' => $config->limit,
                    'status' => 1,
                ],
            ];

            $res = $client->request('GET', $url, $options);
            $response = json_decode($res->getBody()->getContents());
            if ($response->message == 'Success' && $response->data) {
                $data = $response->data;
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return $data;
    }

    public function getTemplateInfo($templateId)
    {
        $config = self::getConfig();
        $client = new Client;
        $detail = (Object) [];

        try {
            $url = env('ZALO_URL_GET_TEMPLATE_INFO_V2');
            $options = [
                'headers' => [
                    'Access_token' => $config->access_token
                ],
                'query' => [
                    'template_id' => $templateId,
                ],
            ];

            $res = $client->request('GET', $url, $options);
            $response = json_decode($res->getBody()->getContents());
            if ($response->message == 'Success' && $response->data) {
                $detail = $response->data;
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return $detail;
    }
}
