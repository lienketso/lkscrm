<?php

namespace Webkul\TaskCategorySetting\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\TaskCategorySetting\Models\TaskCategorySetting::class,
    ];
}
