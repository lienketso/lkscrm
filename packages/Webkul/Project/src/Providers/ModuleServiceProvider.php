<?php

namespace Webkul\Project\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Project\Models\Phase::class,
        \Webkul\Project\Models\Project::class,
        \Webkul\Project\Models\ProjectMember::class,
    ];
}
