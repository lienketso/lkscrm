<?php

namespace Webkul\TaskPrioritySetting\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\TaskPrioritySetting\Models\TaskPrioritySetting::class,
    ];
}
