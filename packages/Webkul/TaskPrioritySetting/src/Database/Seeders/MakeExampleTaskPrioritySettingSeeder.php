<?php

namespace Webkul\TaskPrioritySetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\TaskPrioritySetting\Repositories\TaskPrioritySettingRepository;

class MakeExampleTaskPrioritySettingSeeder extends Seeder
{
    protected $taskPrioritySettingRepo;
    public function __construct(TaskPrioritySettingRepository $taskPrioritySettingRepo)
    {
        $this->taskPrioritySettingRepo = $taskPrioritySettingRepo;
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
                'title' => 'Low',
                'css_class' => 'gray',
                'order' => '1',
            ], [
                'title' => 'Medium',
                'css_class' => 'warning',
                'order' => '2',
            ], [
                'title' => 'High',
                'css_class' => 'p',
                'order' => '3',
            ]
        ];
        foreach ($dataSeeder as $item) {
            $this->taskPrioritySettingRepo->create($item);
        }
    }
}
