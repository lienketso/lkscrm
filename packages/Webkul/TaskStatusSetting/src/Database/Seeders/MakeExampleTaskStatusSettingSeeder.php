<?php

namespace Webkul\TaskStatusSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
//        Model::unguard();

        // Add seeder code here
        $dataSeeder = [
            [
                'title' => 'Chưa bắt đầu',
                'css_class' => 'gray',
                'order' => '1',
            ], [
                'title' => 'Đang thực hiện',
                'css_class' => 'primary',
                'order' => '2',
            ], [
                'title' => 'Hoàn thành',
                'css_class' => 'p',
                'order' => '3',
            ]
        ];
        foreach ($dataSeeder as $item) {
            $this->taskStatusSettingRepo->create($item);
        }
    }
}
