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
        # giờ chỉ cần bên bên zlo xác nhận cái mẫu tích điểm sau đó điền ID đó vào env là đc

        // 'phone' => '84374099263',
        // 'template_id' => '388481',
        // 'template_data' => [
        //     'customer_name' => 'Nguyễn Phúc An',
        //     'address' => '123 Duy Tân',
        //     'booking_code' => 'HD0038',
        //     'schedule_time' => '14:00:00 20/12/2024',
        // ],
        // 'tracking_id' => 'f9f696ec-b7f8-11ef-a2ae-c46516b04a5a'

        $client = new Client();
        $option = [
            'headers' => [
                'access_token' => $config->access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'phone' => 12,
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
