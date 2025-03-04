<?php

namespace Webkul\Installer\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Installer\Database\Seeders\Attribute\DatabaseSeeder as AttributeSeeder;
use Webkul\Installer\Database\Seeders\Core\DatabaseSeeder as CoreSeeder;
use Webkul\Installer\Database\Seeders\EmailTemplate\DatabaseSeeder as EmailTemplateSeeder;
use Webkul\Installer\Database\Seeders\Lead\DatabaseSeeder as LeadSeeder;
use Webkul\Installer\Database\Seeders\User\DatabaseSeeder as UserSeeder;
use Webkul\Installer\Database\Seeders\Workflow\DatabaseSeeder as WorkflowSeeder;
use Webkul\TaskPrioritySetting\Database\Seeders\MakeExampleTaskPrioritySettingSeeder;
use Webkul\TaskStatusSetting\Database\Seeders\MakeExampleTaskStatusSettingSeeder;
use Webkul\TaskCategorySetting\Database\Seeders\MakeExampleTaskCategorySettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param  array  $parameters
     * @return void
     */
    public function run($parameters = [])
    {
//        $this->call(AttributeSeeder::class, false, ['parameters' => $parameters]);
//        $this->call(CoreSeeder::class, false, ['parameters' => $parameters]);
//        $this->call(EmailTemplateSeeder::class, false, ['parameters' => $parameters]);
//        $this->call(LeadSeeder::class, false, ['parameters' => $parameters]);
//        $this->call(UserSeeder::class, false, ['parameters' => $parameters]);
//        $this->call(WorkflowSeeder::class, false, ['parameters' => $parameters]);
        $this->call(MakeExampleTaskStatusSettingSeeder::class);
        $this->call(MakeExampleTaskPrioritySettingSeeder::class);
        $this->call(MakeExampleTaskCategorySettingSeeder::class);
    }
}
