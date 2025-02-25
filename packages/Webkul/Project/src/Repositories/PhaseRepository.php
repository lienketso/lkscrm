<?php

namespace Webkul\Project\Repositories;

use Webkul\Core\Eloquent\Repository;

class PhaseRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Project\Contracts\Phase';
    }

    public function getPhaseByProjectInput($project_id)
    {
        if (!$project_id)
        {
            return [];
        }
        $query = $this->getModel()->when($project_id, function ($sq) use ($project_id) {
            $sq->where('project_id', $project_id);
        });
        return $query->get(['id', 'title'])->toArray();
    }
}
