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

    public function hasProjectAccess($userId, $projectId): bool
    {
        $rs = $this->getModel()->where('id', $projectId)->where(function ($subQ) use ($userId) {
            $subQ->whereHas('members', function ($sq) use ($userId) {
                $sq->where('user_id', $userId);
            })->orWhere('leader_id', $userId);
        })->first();
        if ($rs) return true;
        return false;
    }
}
