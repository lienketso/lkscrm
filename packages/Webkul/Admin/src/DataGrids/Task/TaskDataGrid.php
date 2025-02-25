<?php

namespace Webkul\Admin\DataGrids\Task;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Webkul\DataGrid\DataGrid;
use Webkul\Project\Models\Project;
use Webkul\TaskStatusSetting\Models\TaskStatusSetting;

class TaskDataGrid extends DataGrid
{
    protected $parameters;
    /**
     * Create data grid instance.
     *
     * @return void
     */
    public function __construct($parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
//        $queryBuilder = DB::table('tasks')
//            ->leftJoin('users as assignee', 'assignee.id', '=', 'tasks.assignee_id')
//            ->leftJoin('task_priority_settings', 'task_priority_settings.id', '=', 'tasks.priority_id')
//            ->leftJoin('task_status_settings', 'task_status_settings.id', '=', 'tasks.status_id')
//            ->leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
//            ->join('users', 'projects.leader_id', '=', 'users.id')
//            ->leftJoin('phases', 'phases.id', '=', 'tasks.phase_id')
//            ->where('tasks.deleted_at', null)
//            ->select(
//                'assignee.name as assignee_name',
//                'assignee.image as assignee_img',
//                'users.name as leader_name',
//                'users.image as leader_img',
//                'task_priority_settings.title as task_priority',
//                'task_status_settings.css_class as priority_css_class',
//                'task_status_settings.title as task_status',
//                'task_status_settings.css_class as status_css_class',
//                'phases.title as task_phase',
//                'tasks.id',
//                'tasks.title',
//                'tasks.step',
//                'tasks.start_date',
//                'tasks.end_date',
//                'tasks.created_at',
//            );
//        return $queryBuilder;
        $query = DB::table('tasks')
            ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
            ->leftJoin('users as leaders', 'projects.leader_id', '=', 'leaders.id')
            ->leftJoin('users as assignee', 'tasks.assignee_id', '=', 'assignee.id')
            ->leftJoin('task_priority_settings', 'task_priority_settings.id', '=', 'tasks.priority_id')
            ->leftJoin('task_status_settings', 'task_status_settings.id', '=', 'tasks.status_id')
            ->select(
                'tasks.id',
                'tasks.title',
                'tasks.step',
                'tasks.parent_id', // Thêm parent_id để xác định cha - con
                'tasks.start_date',
                'tasks.end_date',
                'tasks.status_id',
                'projects.title as project_title',
                'leaders.name as leader_name',
                'assignee.name as assignee_name',
                'assignee.image as assignee_img',
                'task_priority_settings.title as task_priority',
                'task_priority_settings.css_class as priority_css_class',
                'task_status_settings.title as task_status',
                'task_status_settings.css_class as status_css_class',
            )
            ->whereNull('tasks.deleted_at')
            ->orderBy('tasks.parent_id') // Sắp xếp theo cha trước
            ->orderBy('tasks.id');

        return $query;
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
            'closure'    => function ($row) {
//            dd($row);
                return [
                    'status' => $row->task_status,
                    'css_class'  => $row->status_css_class,
                ];
            },
        ]);

        $this->addColumn([
            'index'      => 'task_priority',
            'label'      => trans('admin::app.task.index.datagrid.priority'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return [
                    'status' => $row->task_priority,
                    'css_class'  => $row->priority_css_class,
                ];
            },
        ]);

        $this->addColumn([
            'index'      => 'assignee',
            'label'      => trans('admin::app.task.index.datagrid.assignee'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return [
                    'name' => $row->assignee_name,
                    'image'  => $row->assignee_img,
                ];
            },
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
//         if (bouncer()->hasPermission('task.view')) {
//             $this->addAction([
//                 'icon'   => 'icon-eye',
//                 'title'  => trans('admin::app.project.view.title'),
//                 'method' => 'GET',
//                 'url'    => fn ($row) => route('admin.projects.view', $row->id),
//             ]);
             $this->addAction([
                 'icon'   => 'icon-edit',
                 'index'  => 'edit',
                 'title'  => trans('admin::app.task.edit.title'),
                 'method' => 'GET',
                 'url'    => fn ($row) => route('admin.tasks.edit', $row->id),
             ]);

//         }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void
    {
//        $this->addMassAction([
//            'icon'   => 'icon-delete',
//            'title'  => trans('admin::app.settings.users.index.datagrid.delete'),
//            'method' => 'POST',
//            'url'    => route('admin.settings.users.mass_delete'),
//        ]);
        $taskStatus = TaskStatusSetting::all();
        $options = [];
        foreach ($taskStatus ?? [] as $status) {
            $options[] = [
                'label' => $status->title,
                'value' => $status->id,
            ];
        }
        $this->addMassAction([
            'title'   => trans('admin::app.settings.users.index.datagrid.update-status'),
            'method'  => 'POST',
            'url'     => route('admin.tasks.changeTaskStatus'),
            'options' => $options,
        ]);
    }

    public function formatRecords($records): mixed
    {
        $taskList = [];

        // Nhóm các task cha
        foreach ($records as $task) {
            $task->action[] = [
                'icon'   => 'icon-edit',
                'index'  => 'edit',
                'title'  => trans('admin::app.task.edit.title'),
                'method' => 'GET',
                'url'    => fn ($row) => route('admin.tasks.edit', $task->id),
            ];
            if ($task->parent_id === null) {
                $task->sub_tasks = []; // Tạo mảng chứa subtask
                $taskList[$task->id] = $task;
            }
        }

        // Gán sub-tasks vào tasks cha
        foreach ($records as $task) {
            if ($task->parent_id !== null && isset($taskList[$task->parent_id])) {
                $taskList[$task->parent_id]->sub_tasks[] = $task;
            }
        }

        return array_values($taskList);
    }


}
