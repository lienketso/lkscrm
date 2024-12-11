<?php

namespace Webkul\Core\Console\Commands;

use Illuminate\Console\Command;
use Webkul\Lead\Models\ZaloConfig;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;

class ZNSGetToken extends Command
{
    /**
     * The name and signature of the console command.
     * 
     * command này sẽ được gọi bằng crontab 
     * 
     * @var string
     */
    protected $signature = 'zns_get_token_by_refresh_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zns get token by refresh token';

    /**
     * 
     */
    protected $appId;
    protected $secretKey;
    protected $idZaloConfig;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->appId = env('ZALO_APP_ID');
        $this->secretKey = env('ZALO_SECRET_KEY');
        $this->idZaloConfig = 1;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $config = ZaloConfig::where('id', $this->idZaloConfig)->first();
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
        \Log::error($content); // log kết quả đẻ tiện theo dõi trên file log của laravel
        $content = json_decode($content);

        if (isset($content->access_token) && $content->access_token) {
            # lưu lại thông tin config vào db
            $config->access_token = $content->access_token;
            $config->refresh_token = $content->refresh_token;
            $config->token_expired_at = time() + $content->expires_in - 600;
            $config->save();
        }

        return true;
    }
}
