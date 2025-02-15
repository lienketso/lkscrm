<?php

namespace Webkul\Task\Repositories;

use Webkul\Core\Eloquent\Repository;

class TaskRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Task\Contracts\Task';
    }
}
