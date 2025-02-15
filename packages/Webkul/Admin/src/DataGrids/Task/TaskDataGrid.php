<?php

namespace Webkul\Admin\DataGrids\Task;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\Project\Models\Project;

class TaskDataGrid extends DataGrid
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
        $queryBuilder = DB::table('tasks')
            ->leftJoin('users', 'users.id', '=', 'tasks.assignee_id')
            ->leftJoin('task_priority_settings', 'task_priority_settings.id', '=', 'tasks.priority_id')
            ->leftJoin('task_status_settings', 'task_status_settings.id', '=', 'tasks.status_id')
            ->leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
            ->leftJoin('phases', 'phases.id', '=', 'tasks.phase_id')
            ->where('tasks.deleted_at', null)
            ->select(
                'users.name as assignee',
//                'projects.users.name as leader',
                'task_priority_settings.title as task_priority',
                'task_status_settings.title as task_status',
                'phases.title as task_phase',
                'tasks.id',
                'tasks.title',
                'tasks.step',
                'tasks.start_date',
                'tasks.end_date',
                'tasks.created_at',
            );
        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.task.index.datagrid.title'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);
        $this->addColumn([
            'index'      => 'step',
            'label'      => trans('admin::app.task.index.datagrid.step'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'task_status',
            'label'      => trans('admin::app.task.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'task_priority',
            'label'      => trans('admin::app.task.index.datagrid.priority'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

//        $this->addColumn([
//            'index'      => 'leader',
//            'label'      => trans('admin::app.task.index.datagrid.leader'),
//            'type'       => 'string',
//            'sortable'   => false,
//            'filterable' => true,
//        ]);

        $this->addColumn([
            'index'      => 'assignee',
            'label'      => trans('admin::app.task.index.datagrid.assignee'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);



        $this->addColumn([
            'index'      => 'start_date',
            'label'      => trans('admin::app.task.index.datagrid.start_date'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return !is_null($row->start_date) ? date('d/m/Y', strtotime($row->start_date)) : "";
            },
        ]);

        $this->addColumn([
            'index'      => 'end_date',
            'label'      => trans('admin::app.task.index.datagrid.end_date'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return !is_null($row->start_date) ? date('d/m/Y', strtotime($row->end_date)) : "";
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
