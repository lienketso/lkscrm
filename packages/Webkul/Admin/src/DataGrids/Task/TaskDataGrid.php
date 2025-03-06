<?php

namespace Webkul\Admin\DataGrids\Task;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\TaskStatusSetting\Models\TaskStatusSetting;

class TaskDataGrid extends DataGrid
{
    /**
     * Create data grid instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $query = DB::table('tasks')
            ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
            ->leftJoin('users as leaders', 'projects.leader_id', '=', 'leaders.id')
            ->leftJoin('users as assignee', 'tasks.assignee_id', '=', 'assignee.id')
            ->leftJoin('users as createdBy', 'tasks.created_by', '=', 'createdBy.id')
            ->leftJoin('task_priority_settings', 'task_priority_settings.id', '=', 'tasks.priority_id')
            ->leftJoin('task_status_settings', 'task_status_settings.id', '=', 'tasks.status_id')
            ->select(
                'tasks.id',
                'tasks.title',
                'tasks.parent_id', // Thêm parent_id để xác định cha - con
                'tasks.start_date',
                'tasks.end_date',
                'tasks.status_id',
                'projects.title as project_title',
                'leaders.name as leader_name',
                'assignee.name as assignee_name',
                'assignee.image as assignee_img',
                'createdBy.name as createdBy_name',
                'createdBy.image as createdBy_img',
                'task_priority_settings.title as task_priority',
                'task_priority_settings.css_class as priority_css_class',
                'task_status_settings.title as task_status',
                'task_status_settings.css_class as status_css_class',
            )
            ->whereNull('tasks.deleted_at')
            ->orderBy('tasks.parent_id') // Sắp xếp theo cha trước
            ->orderBy('tasks.created_at', 'DESC');

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
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'end_date',
            'label'      => trans('admin::app.task.index.datagrid.end_date'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'createdBy',
            'label'      => trans('admin::app.task.index.datagrid.created_by'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
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
            $task->actions[] = [
                'icon'   => 'icon-edit',
                'index'  => 'edit',
                'title'  => trans('admin::app.task.edit.title'),
                'method' => 'GET',
                'url'    => route('admin.tasks.edit', $task->id)
            ];
            $task->start_date = !is_null($task->start_date) ? date('d/m/Y', strtotime($task->start_date)) : "";
            $task->end_date = !is_null($task->end_date) ? date('d/m/Y', strtotime($task->end_date)) : "";
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
