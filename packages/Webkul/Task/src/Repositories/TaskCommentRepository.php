<?php

namespace Webkul\Task\Repositories;

use Webkul\Core\Eloquent\Repository;

class TaskCommentRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Task\Contracts\TaskComment';
    }

    public function getCommentByTaskId($taskId)
    {
        return $this->model->with(['user', 'task'])->whereHas('task', function ($query) use ($taskId){
            return $query->whereId($taskId);
        })->orderBy('created_at', 'DESC')->get();
    }
}