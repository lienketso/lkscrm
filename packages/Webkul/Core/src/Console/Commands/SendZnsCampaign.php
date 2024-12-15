<?php
namespace Webkul\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Webkul\Core\Jobs\SendZNS;
use Webkul\Core\Jobs\QueueName;
use Webkul\Lead\Models\CampaignSchedule;
class SendZnsCampaign extends Command
{
    /**
     * The name and signature of the console command.
     * 
     * command này sẽ được gọi bằng crontab 
     * 
     * @var string
     */
    protected $signature = 'send-zns-campaign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'semd zns campaign command';

    /**
     * Create a new command instance.
     *
     * 1 chiến dịch marketing: Campaign
     * + N khánh hàng lưu trong bảng CampaignCustomer
     * + N schedule: CampaignSchedule
     *    - Mỗi schedule sẽ có thời gian khác nhau và tempalte_id khác nhau
     *    - Với mỗi tempalte_id khác nhau sẽ có params khác nhau
     * ===> vậy phương án để gủi ZNS ở đây là:
     * - Tạo 1 con jobs đặt lịch cứ 6h30 AM là query bảng CampaignSchedule xem ngày hôm đó có lịch nào cần gửi tin nhắn hay không
     *    . Nếu có lịch gửi zns thì sẽ xử lý đưa hết vào queue để chạy cho toàn bộ khách hàn thuộc chiến dịch này
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d');
        $listCampaignSchedules = CampaignSchedule::startAt($date)->notDone()->get();
        foreach ($listCampaignSchedules as $schedule) {

            $scheduleContents = $schedule->scheduleContent;
            $campaignCustomers = $schedule->campaign->customers;
            
            # lấy thông tin template_data trước
            $templateData = [];
            foreach ($scheduleContents as $param) {
                $templateData[$param->zaloTemplateInfo->name] = $param->content;
            }

            if (count($campaignCustomers) > 0 && count($templateData) > 0) {

                foreach ($campaignCustomers as $customer) {
                    $customerInfo = $customer->lead;
                    $contactNumbers = $customerInfo->person->contact_numbers;
                    
                    if (count($contactNumbers) > 0 && $contactNumbers[0]['value'] != '') {
                        
                        $number = $contactNumbers[0];
                        $number = '84' . substr($number['value'], 1);

                        $tmpTemplateData = $templateData;
                        # lấy lại tên khách hàng theo lead 
                        $tmpTemplateData['customer_name'] = $customerInfo->title;
                        
                        $param = [
                            'phone' => $number,
                            'template_id' => $schedule->zalo_template_id,
                            'template_data' => $tmpTemplateData,
                            'tracking_id' => Str::uuid(),
                        ];

                        dispatch(new SendZNS($param))->onQueue(QueueName::SEND_ZNS_CAMPAIGN);
                    }
                }
            }
            
            # chuyển trạng thái cho CampaignSchedules về done sau khi đã đẩy hết nội dung tin nhắn cho từng khách hàng vào queue
            $schedule->status = CampaignSchedule::DONE;
            $schedule->save();
        }

        \Log::info('done schedule campaign in date: ' . $date);
        return true;
    }
}
