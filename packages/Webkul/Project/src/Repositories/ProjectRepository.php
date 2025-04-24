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

    public function getMyProjectListSelectInput()
    {
        return $this->getModel()->where(function($query){
            $query->where('leader_id', auth()->user()->id)
                ->orWhereHas('members', function($query){
                    $query->where('user_id', auth()->user()->id);
                })
                ;
        })->get(['id', 'title'])->toArray();
    }
}
