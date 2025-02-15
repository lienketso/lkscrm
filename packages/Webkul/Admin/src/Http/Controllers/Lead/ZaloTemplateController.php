<?php

namespace Webkul\Admin\Http\Controllers\Lead;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Lead\ZaloTemplateDataGrid;
use Webkul\Lead\Models\ZaloTemplate;
use Webkul\Lead\Models\ZaloTemplateInfo;
use Webkul\Lead\Models\ZaloZnsMessages;
use Illuminate\Http\Request;

class ZaloTemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        // do some thing
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(ZaloTemplateDataGrid::class)->process();
        }

        return view('admin::zalo.template');
    }

    public function syncZaloMessageTemplate()
    {
        // Event::dispatch('zalo.template.before');

        Event::dispatch('zalo.template.after');

        session()->flash('success', trans('admin::app.zalo.sync_template_from_zalo_mes'));

        return redirect()->route('admin.zalo.template.index');
    }

    /**
     * Display a resource.
     */
    public function view(int $id)
    {
        $template = ZaloTemplate::findOrFail($id);
        // dd($template->id);

        return view('admin::zalo.view-template', compact('template'));
    }

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
