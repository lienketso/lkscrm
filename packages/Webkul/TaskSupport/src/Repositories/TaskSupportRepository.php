<?php

namespace Webkul\TaskSupport\Repositories;

use Webkul\Core\Eloquent\Repository;

class TaskSupportRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\TaskSupport\Contracts\TaskSupport';
    }
}
