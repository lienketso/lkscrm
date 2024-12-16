<?php

namespace Webkul\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Webkul\Lead\Models\ZaloConfig;
use Webkul\Lead\Models\ZaloZnsMessages;
use GuzzleHttp\Client;;

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
        $params = $this->params;
        $option = [
            'headers' => [
                'access_token' => $config->access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($params),
        ];

        # lưu vào bảng zns_messages
        $modelZns = new ZaloZnsMessages();
        $modelZns->phone = $params['phone'];
        $modelZns->template_id = $params['template_id'];
        $modelZns->template_data = json_encode($params);
        $modelZns->tracking_id = $params['tracking_id'];
        $modelZns->save();
        \Log::info($option['body']);

        $rs = $client->request('POST', $this->url, $option);
        $response = (Object) [
            'code' => $rs->getStatusCode(),
            'result' => json_decode($rs->getBody()->getContents()),
        ];

        if ($response->code == 200 && $response->result->error == 0) {
            # xử lý gì khi thành công hay không
            \Log::info(json_encode($response));
            $modelZns->status = ZaloZnsMessages::SENT;
        } else {
            # gửi thất bại
            \Log::error(json_encode($response));
            $modelZns->status = ZaloZnsMessages::SEND_FALSE;
        }
        $modelZns->save();

        return true;
    }
}
