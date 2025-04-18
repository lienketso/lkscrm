<?php

namespace Webkul\Task\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Task\Models\Task::class,
        \Webkul\Task\Models\TaskComment::class
    ];
}
