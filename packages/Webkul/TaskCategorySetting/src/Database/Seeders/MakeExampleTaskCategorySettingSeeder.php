<?php

namespace Webkul\TaskCategorySetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webkul\TaskCategorySetting\Repositories\TaskCategorySettingRepository;

class MakeExampleTaskCategorySettingSeeder extends Seeder
{
    protected $taskCategorySettingRepo;
    public function __construct(TaskCategorySettingRepository $taskCategorySettingRepo)
    {
        $this->taskCategorySettingRepo = $taskCategorySettingRepo;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_category_settings')->truncate();

        // Add seeder code here
        $dataSeeder = [
            [
                'title' => 'MKT',
                'order' => '1',
            ], [
                'title' => 'Sale',
                'order' => '2',
            ], [
                'title' => 'System',
                'order' => '3',
            ], [
                'title' => 'QLDN',
                'order' => '4',
            ]
        ];
        foreach ($dataSeeder as $item) {
            $this->taskCategorySettingRepo->create($item);
        }
    }
}
