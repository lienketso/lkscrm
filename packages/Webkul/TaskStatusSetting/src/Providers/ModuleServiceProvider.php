<?php

namespace Webkul\TaskStatusSetting\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\TaskStatusSetting\Models\TaskStatusSetting::class,
    ];
}
