<?php

namespace Webkul\TaskPrioritySetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('task_priority_settings')->truncate();

        // Add seeder code here
        $dataSeeder = [
            [
                'title' => 'Low',
                'css_class' => 'label-warning',
                'order' => '1',
            ], [
                'title' => 'Medium',
                'css_class' => 'label-primary',
                'order' => '2',
            ], [
                'title' => 'High',
                'css_class' => 'label-inactive',
                'order' => '3',
            ]
        ];
        foreach ($dataSeeder as $item) {
            $this->taskPrioritySettingRepo->create($item);
        }
    }
}
