<?php

namespace Webkul\TaskSupport\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\TaskSupport\Models\TaskSupport::class,
    ];
}
