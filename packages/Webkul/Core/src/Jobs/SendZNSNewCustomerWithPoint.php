<?php

namespace Webkul\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Webkul\Lead\Models\ZaloConfig;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class SendZNSNewCustomerWithPoint implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $leadInfo;
    protected $url;
    protected $idZaloConfig;
    protected $templateIdNewCustomer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($leadInfo)
    {
        $this->leadInfo = $leadInfo;
        $this->url = env('ZALO_URL_SEND_ZNS');
        $this->templateIdNewCustomer = env('ZALO_TEMPLATE_ID_NEW_CUSTOMER');
        $this->idZaloConfig = 1;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $config = ZaloConfig::where('id', $this->idZaloConfig)->first();
        $leadInfo = $this->leadInfo;

        # phần này là conver lại số điện thoại về dạng 84xxxxxxxxx
        if (env('APP_ENV') != 'production') {
            $phone = '';
        } else {
            # 84374099263 annp 
            # 84963775533 hoàng minh hải
            $phone = "84963775533";
        }

        $client = new Client();
        $option = [
            'headers' => [
                'access_token' => $config->access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'phone' => $phone,
                'template_id' => $this->templateIdNewCustomer,
                'template_data' => [
                    'customer_name' => $leadInfo->title,
                    'total_point' => 100,
                    'customer_code' => $leadInfo->code ?: 'KH_' . $leadInfo->id,
                ],
                'tracking_id' => Str::uuid(),
            ]),
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
