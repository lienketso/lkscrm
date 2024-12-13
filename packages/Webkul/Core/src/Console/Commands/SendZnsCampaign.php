<?php
namespace Webkul\Core\Console\Commands;

use Illuminate\Console\Command;
use Webkul\Lead\Models\Campaign;
use Webkul\Lead\Models\CampaignSchedule;
use Webkul\Lead\Models\CampaignScheduleContent;
use Webkul\Lead\Models\CampaignCustomer;
use Webkul\Lead\Models\ZaloTemplate;

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

            // $campaign = $schedule->campaign;
            $scheduleContents = $schedule->scheduleContent;
            $campaignCustomers = $schedule->campaign->customers;
            $zaloTemplate = $schedule->zaloTemplate; // thông tin template zns
            $zaloTemplateInfo = $zaloTemplate->info; // thông tin các params thuộc template zns
            // dd($zaloTemplateInfo);
            
            # tạo param để gửi zns cho từng khách hàng trong chiến dịch này
            if (count($campaignCustomers) > 0) {
                foreach ($campaignCustomers as $customer) {
                    $customerInfo = $customer->lead;
                    $contactNumbers = $customerInfo->person->contact_numbers;
                    if (count($contactNumbers) > 0) {
                        $tmp = $contactNumbers[0];
                        $templateData = [];
                        foreach ($zaloTemplateInfo as $param) {
                            
                        }

                        $param = [
                            'phone' => $tmp->value,
                            'template_id' => $schedule->zalo_template_id,
                            'template_data' => [],
                        ];
                    }
                }
            }
            
            # chuyển trạng thái cho CampaignSchedules về done sau khi đã đẩy hết nội dung tin nhắn cho từng khách hàng vào queue
            $schedule->status = CampaignSchedule::DONE;
            $schedule->save();
        }

        return true;
    }
}
