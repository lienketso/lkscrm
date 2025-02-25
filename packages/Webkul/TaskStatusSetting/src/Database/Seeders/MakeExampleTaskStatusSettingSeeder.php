<?php

namespace Webkul\TaskStatusSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Webkul\TaskStatusSetting\Models\TaskStatusSetting;
use Webkul\TaskStatusSetting\Repositories\TaskStatusSettingRepository;

class MakeExampleTaskStatusSettingSeeder extends Seeder
{
    protected $taskStatusSettingRepo;

    public function __construct(TaskStatusSettingRepository $taskStatusSettingRepo)
    {
        $this->taskStatusSettingRepo = $taskStatusSettingRepo;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_status_settings')->truncate();
        // Add seeder code here
        $dataSeeder = [
            [
                'title' => 'Chưa bắt đầu',
                'css_class' => 'label-warning',
                'order' => '1',
            ], [
                'title' => 'Đang thực hiện',
                'css_class' => 'label-info',
                'order' => '2',
            ], [
                'title' => 'Hoàn thành',
                'css_class' => 'label-active',
                'order' => '3',
            ]
        ];
        foreach ($dataSeeder as $item) {
            $this->taskStatusSettingRepo->create($item);
        }
    }
}
