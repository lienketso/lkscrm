<?php

namespace Webkul\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Webkul\Lead\Models\ZaloConfig;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;

class DemoJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $params;
    protected $appId;
    protected $secretKey;
    protected $idZaloConfig;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
        $this->appId = env('ZALO_APP_ID');
        $this->secretKey = env('ZALO_SECRET_KEY');
        $this->idZaloConfig = 1;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = (Object) $this->params;
        $config = ZaloConfig::where('id', $this->idZaloConfig)->first();

        $client = new Client();
        $uri = 'https://business.openapi.zalo.me/message/template';
        $option = [
            'headers' => [
                'access_token' => $config->access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'phone' => $params->phone_number,
                'template_id' => $params->template_id,
                'template_data' => [
                    "customer_name" => "Nguyễn Phúc An",
                    "address" => "123 Duy Tân",
                    "booking_code" => "HD0038",
                    "schedule_time" => "14:00:00 20/12/2024",
                ],
                'tracking_id' => 'f9f696ec-b7f8-11ef-a2ae-c46516b04a5a',
            ])
        ];

        // dd($option);

        $rs = $client->request('POST', $uri, $option);
        $response = (Object) [
            'code' => $rs->getStatusCode(),
            'result' => json_decode($rs->getBody()->getContents()),
        ];

        dd($response);

        return $response;
    }
}
