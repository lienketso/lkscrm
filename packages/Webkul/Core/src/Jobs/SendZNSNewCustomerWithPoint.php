<?php

namespace Webkul\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Webkul\Lead\Models\ZaloConfig;
use Webkul\Lead\Models\ZaloZnsMessages;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class SendZNSNewCustomerWithPoint implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $leadInfo;
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
        $this->idZaloConfig = env('ZALO_CONFIG_ID');
        $this->templateIdNewCustomer = env('ZALO_TEMPLATE_ID_NEW_CUSTOMER');
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
        if (env('APP_ENV') == 'production') {
            $contactNumbers = $leadInfo->person->contact_numbers;
            if (count($contactNumbers) > 0 && $contactNumbers[0]['value'] != '') {
                $phone = $contactNumbers[0]['value'];
                $phone = '84' . substr($phone, 1);
            } 
        } else {
            # 84374099263 annp 
            # 84963775533 hoàng minh hải
            $phone = env('ZALO_PHONE_DEFAULT', '84374099263');
        }

        $client = new Client();
        $trackingId = Str::uuid();
        $templateData = [
            'customer_name' => $leadInfo->title,
            'total_point' => 100,
            'customer_code' => $leadInfo->code ?: 'KH_' . $leadInfo->id,
        ];
        $option = [
            'headers' => [
                'access_token' => $config->access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'phone' => $phone,
                'template_id' => $this->templateIdNewCustomer,
                'template_data' => $templateData,
                'tracking_id' => $trackingId,
            ]),
        ];

        # lưu vào bảng zns_messages
        $modelZns = new ZaloZnsMessages();
        $modelZns->phone = $phone;
        $modelZns->template_id = $this->templateIdNewCustomer;
        $modelZns->template_data = json_encode($templateData);
        $modelZns->tracking_id = $trackingId;
        $modelZns->app_id = $this->appId;
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
            $modelZns->msg_id = $response->result->data->msg_id ?? null;
            $modelZns->sent_time = $response->result->data->sent_time ?? null;
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
