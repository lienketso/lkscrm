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

class SendZNS implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $params;
    protected $url;
    protected $idZaloConfig;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
        $this->url = env('ZALO_URL_SEND_ZNS');
        $this->idZaloConfig = env('ZALO_CONFIG_ID');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $config = ZaloConfig::where('id', $this->idZaloConfig)->first();
        $client = new Client();
        $option = [
            'headers' => [
                'access_token' => $config->access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($this->params),
        ];

        $rs = $client->request('POST', $this->url, $option);
        $response = (Object) [
            'code' => $rs->getStatusCode(),
            'result' => json_decode($rs->getBody()->getContents()),
        ];

        if ($response->code == 200 && $response->result->error == 0) {
            # xử lý gì khi thành công hay không
            \Log::info(json_encode($response));
        } else {
            # gửi thất bại
            \Log::error(json_encode($response));
        }

        return true;
    }
}
