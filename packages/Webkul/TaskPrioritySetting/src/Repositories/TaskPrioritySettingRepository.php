<?php

namespace Webkul\TaskPrioritySetting\Repositories;

use Webkul\Core\Eloquent\Repository;

class TaskPrioritySettingRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\TaskPrioritySetting\Contracts\TaskPrioritySetting';
    }

    public function getTaskPrioritySettingInput()
    {
        return $this->getModel()->get(['id', 'title'])->toArray();
    }
}
