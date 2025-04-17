<?php

namespace Webkul\Admin\DataGrids\Project;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Webkul\Project\Repositories\ProjectRepository;

class MyProjectDataGrid extends ProjectDataGrid
{
    public $projectRepo;

    /**
     * Create data grid instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $userId = Auth::id();
        $queryBuilder = DB::table('projects')
            ->leftJoin('users', 'users.id', '=', 'projects.leader_id')
            ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id') // Join with members table
            ->whereNull('projects.deleted_at')
            ->where(function ($query) use ($userId) {
                $query->where('projects.leader_id', $userId)
                ->orWhere('project_members.user_id', $userId); // Check if user is a member
            })
            
            ->select(
                'users.id as leader_id',
                'users.name as leader_name',
                'users.image as leader_image',
                'projects.id',
                'projects.title',
                'projects.description',
                'projects.status',
                'projects.member_type',
                'projects.created_at',
                'projects.start_date',
                'projects.end_date',
            )->orderBy('created_at', 'DESC');
        return $queryBuilder;
    }
}