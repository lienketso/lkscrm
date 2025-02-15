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
            ->where('projects.deleted_at', null)
            ->select(
                'users.id as leader_id',
                'users.name as leader_name',
                'projects.id',
                'projects.title',
                'projects.status',
                'projects.created_at',
            );
        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.project.index.datagrid.id'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.project.index.datagrid.title'),
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
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.project.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return Project::STATUS[$row->status];
            },
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.project.index.datagrid.created-at'),
            'type'       => 'string',
            'sortable'   => true,
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
//             $this->addAction([
//                 'icon'   => 'icon-eye',
//                 'title'  => trans('admin::app.project.view.title'),
//                 'method' => 'GET',
//                 'url'    => fn ($row) => route('admin.projects.view', $row->id),
//             ]);
//             $this->addAction([
//                 'icon'   => 'icon-edit',
//                 'title'  => trans('admin::app.project.edit.title'),
//                 'method' => 'GET',
//                 'url'    => fn ($row) => route('admin.projects.edit', $row->id),
//             ]);
         }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void
    {
        
    }
}
