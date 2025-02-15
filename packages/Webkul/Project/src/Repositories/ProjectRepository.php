<?php

namespace Webkul\Project\Repositories;

use Webkul\Core\Eloquent\Repository;

class ProjectRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Project\Contracts\Project';
    }

    public function getProjectListSelectInput()
    {
        return $this->getModel()->get(['id', 'title'])->toArray();
    }
}
