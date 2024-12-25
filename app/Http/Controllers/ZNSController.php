<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Webkul\Lead\Models\ZaloZnsMessages;

class ZNSController extends BaseController
{
    
    public function handleWebhook(Request $request)
    {
        $data = $request->all();

        # Kiểm tra sự kiện "user_received_message"
        if (isset($data['event_name']) && $data['event_name'] === 'user_received_message') {
            $userId = $data['recipient']['id'];
            $appId = $data['app_id']; // ID của ứng dụng gửi tin (ứng dụng mà OA đã cấp quyền)
            $msgId = $data['message']['msg_id']; // ID của thông báo
            $trackingId = $data['message']['tracking_id']; // Mã số đánh dấu lần gọi API của đối tác, do đối tác định nghĩa.
            $deliveryTime = $data['message']['delivery_time']; // Thời gian thiết bị của người dùng nhận được thông báo ZNS

            # Log thông tin sự kiện
            \Log::info("User $userId đã nhận tin nhắn $msgId tại $deliveryTime!");

            # Thực hiện logic khác như cập nhật DB, gửi thông báo, v.v.
            $modelZns = ZaloZnsMessages::where('app_id', $appId)->where('tracking_id', $trackingId)->where('msg_id', $msgId)->first();
            $modelZns->event_name = $data['event_name'];
            $modelZns->delivery_time = $deliveryTime;
            $modelZns->save();
        }

        return response()->json(['status' => 'success']);
    }
}
