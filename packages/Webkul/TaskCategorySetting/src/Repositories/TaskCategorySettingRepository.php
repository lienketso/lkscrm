<?php

namespace Webkul\TaskCategorySetting\Repositories;

use Webkul\Core\Eloquent\Repository;

class TaskCategorySettingRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\TaskCategorySetting\Contracts\TaskCategorySetting';
    }

    public function getTaskCategorySettingInput()
    {
        return $this->getModel()->get(['id', 'title'])->toArray();
    }
}
