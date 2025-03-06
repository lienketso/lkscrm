<?php

namespace Webkul\Admin\DataGrids\Project;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\Project\Models\Project;

class ProjectDataGrid extends DataGrid
{
    /**
     * Create data grid instance.
     *
     * @return void
     */
    public function __construct() 
    {
        // do something
    }

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $queryBuilder = DB::table('projects')
            ->leftJoin('users', 'users.id', '=', 'projects.leader_id')
            ->whereNull('projects.deleted_at')
            ->select(
                'users.id as leader_id',
                'users.name as leader_name',
                'users.image as leader_image',
                'projects.id',
                'projects.title',
                'projects.description',
                'projects.status',
                'projects.created_at',
            )->orderBy('created_at', 'DESC');
        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.project.index.datagrid.title'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'description',
            'label'      => trans('admin::app.project.index.datagrid.description'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'leader_name',
            'label'      => trans('admin::app.project.index.datagrid.leader'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                if ($row->leader_image) {
                    $html = <<<HTML
                    <div class="border-3 mr-2 inline-block h-9 w-9 overflow-hidden rounded-full border-gray-800 text-center align-middle">
                        <img class="h-9 w-9" :src="$row->leader_image" alt="$row->leader_name" />
                    </div>
                HTML;
                } else {
                    $firstLetter = strtoupper($row->leader_name[0]);
                    $html = <<<HTML
                    <div class="profile-info-icon">
                        <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-blue-400 text-sm font-semibold leading-6 text-white transition-all hover:bg-blue-500 focus:bg-blue-500">
                            $firstLetter
                        </button>
                    </div>
                    <div class="text-sm">
                        $row->leader_name
                    </div>
                HTML;
                }

                return <<<HTML
                        <div class="flex items-center gap-2.5">
                           $html
                        </div> 
                HTML;
            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.project.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
            $status = Project::STATUS[$row->status];
            $statusCssClass = $row->status == Project::ACTIVE ? 'label-active' : 'label-inactive';
                return <<<HTML
                        <span class="$statusCssClass"
                            >
                                $status
                            </span>
                    HTML;
            },
        ]);

        $this->addColumn([
            'index'      => 'member',
            'label'      => trans('admin::app.project.index.datagrid.member'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return DB::table('project_members')
                    ->join('users', 'users.id', '=', 'project_members.user_id')
                    ->where('project_members.project_id', $row->id)
                    ->select('users.id as member_id', 'users.name as member_name', 'users.image as member_image')
                    ->get();
            },
        ]);


        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.project.index.datagrid.created-at'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return date('d/m/Y H:i:s', strtotime($row->created_at));
            },
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
         if (bouncer()->hasPermission('project.view')) {
             $this->addAction([
                 'index'  => 'listPhase',
                 'icon'   => 'icon-list',
                 'title'  => trans('admin::app.project.view.phase'),
                 'method' => 'GET',
                 'url'    => fn ($row) => route('admin.phases.index', $row->id),
             ]);
             $this->addAction([
                 'index'  => 'edit',
                 'icon'   => 'icon-edit',
                 'title'  => trans('admin::app.project.edit.title'),
                 'method' => 'GET',
                 'url'    => fn ($row) => route('admin.projects.edit', $row->id),
             ]);
         }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void
    {
        
    }
}
