<?php

namespace Webkul\TaskStatusSetting\Repositories;

use Webkul\Core\Eloquent\Repository;

class TaskStatusSettingRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\TaskStatusSetting\Contracts\TaskStatusSetting';
    }

    public function getTaskStatusSettingInput()
    {
        return $this->getModel()->get(['id', 'title'])->toArray();
    }
}
