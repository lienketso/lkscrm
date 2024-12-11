<?php

namespace Webkul\Core\Console\Commands;

use Illuminate\Console\Command;
use Webkul\Lead\Models\ZaloConfig;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;
use Webkul\Core\Jobs\DemoJob;
use Webkul\Core\Jobs\SendZNS;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     * 
     * command này sẽ được gọi bằng crontab 
     * 
     * @var string
     */
    protected $signature = 'test-cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test command';

    /**
     * Create a new command instance.
     *
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

        // 'phone' => $params->phone_number,
        // 'template_id' => $params->template_id,
        // 'template_data' => [
        //     "customer_name" => "Nguyễn Phúc An",
        //     "address" => "123 Duy Tân",
        //     "booking_code" => "HD0038",
        //     "schedule_time" => "14:00:00 20/12/2024",
        // ],
        // 'tracking_id' => 'f9f696ec-b7f8-11ef-a2ae-c46516b04a5a',

        dispatch(new SendZNS([
            'phone' => '84374099263',
            'template_id' => '388481',
            'template_data' => [
                'customer_name' => 'Nguyễn Phúc An',
                'address' => '123 Duy Tân',
                'booking_code' => 'HD0038',
                'schedule_time' => '14:00:00 20/12/2024',
            ],
            'tracking_id' => 'f9f696ec-b7f8-11ef-a2ae-c46516b04a5a'
        ]))->onQueue('test_queue');

        return true;
    }
}
