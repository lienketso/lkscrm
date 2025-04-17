<?php

namespace Webkul\Admin\DataGrids\Task;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\TaskStatusSetting\Models\TaskStatusSetting;
use Webkul\User\Models\User;

class MyTaskDataGrid extends DataGrid
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
        // $projectId = request('project_id');
        // $phaseId = request('phase_id');
        // $assigneeId = request('assignee_id');
        $statusId = request('status_id');
        $priorityId = request('priority_id');
        $query = DB::table('tasks')
            ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
            ->leftJoin('phases', 'tasks.phase_id', '=', 'phases.id')
            ->leftJoin('users as leaders', 'projects.leader_id', '=', 'leaders.id')
            ->leftJoin('users as assignee', 'tasks.assignee_id', '=', 'assignee.id')
            ->leftJoin('users as createdBy', 'tasks.created_by', '=', 'createdBy.id')
            ->leftJoin('task_priority_settings', 'task_priority_settings.id', '=', 'tasks.priority_id')
            ->leftJoin('task_status_settings', 'task_status_settings.id', '=', 'tasks.status_id')
            ->select(
                'tasks.id',
                'tasks.title',
                'tasks.project_id',
                'tasks.phase_id',
                'tasks.parent_id', // Thêm parent_id để xác định cha - con
                'tasks.start_date',
                'tasks.end_date',
                'tasks.status_id',
                'projects.title as project_title',
                'phases.title as phase_title',
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
            ->where('tasks.assignee_id', auth()->user()->id) // Lọc theo người dùng hiện tại
            ->when($statusId, function (Builder $query, $statusId) {
                $query->where('tasks.status_id', $statusId);
            })
            ->when($priorityId, function (Builder $query, $priorityId) {
                $query->where('tasks.priority_id', $priorityId);
            })
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
            'custom_grid' => '4fr',
        ]);

        $this->addColumn([
            'index'      => 'project_title',
            'label'      => trans('admin::app.task.index.datagrid.project'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'custom_grid' => '2fr',
        ]);

        $this->addColumn([
            'index'      => 'phase_title',
            'label'      => trans('admin::app.task.index.datagrid.phase'),
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
            'custom_grid' => '2fr',
        ]);

        $this->addColumn([
            'index'      => 'userSupport',
            'label'      => trans('admin::app.task.index.datagrid.support'),
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
            'index'      => 'time_remaining',
            'label'      => trans('admin::app.task.index.datagrid.time_remaining'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => false,
        ]);

        $this->addColumn([
            'index'      => 'createdBy',
            'label'      => trans('admin::app.task.index.datagrid.created_by'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'custom_grid' => '.7fr',
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
//         if (bouncer()->hasPermission('task.view')) {
        $this->addAction([
            'icon'   => 'icon-add',
            'index'  => 'createSubTask',
            'title'  => trans('admin::app.task.create.title'),
            'method' => 'GET',
            'url'    => fn ($row) => route('admin.tasks.store'),
        ]);
        $this->addAction([
            'icon'   => 'icon-edit',
            'index'  => 'edit',
            'title'  => trans('admin::app.task.edit.title'),
            'method' => 'GET',
            'url'    => fn ($row) => route('admin.tasks.edit', $row->id),
        ]);
        $this->addAction([
            'index'  => 'delete',
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.task.delete.title'),
            'method' => 'DELETE',
            'url'    => fn ($row) => route('admin.tasks.delete', $row->id),
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
            $task->actions = [
                [
                    'icon'   => 'icon-message',
                    'index'  => 'comment',
                    'title'  => trans('admin::app.task.comment.title'),
                    'method' => 'GET',
                    'url'    => route('admin.tasks.getCommentByTaskId', ['task_id' => $task->id]),
                    'task_id' => $task->id,
                    'project_id' => request('project_id')
                ], [
                    'icon'   => 'icon-edit',
                    'index'  => 'edit',
                    'title'  => trans('admin::app.task.edit.title'),
                    'method' => 'GET',
                    'url'    => route('admin.tasks.edit', $task->id)
                ],[
                    'index'  => 'delete',
                    'icon'   => 'icon-delete',
                    'title'  => trans('admin::app.task.delete.title'),
                    'method' => 'DELETE',
                    'url'    => route('admin.tasks.delete', $task->id),
                ]
            ];

            $task->userSupport = User::whereHas('taskSupport', function ($query) use ($task) {
                return $query->where('tasks.id', $task->id);
            })->get();
            $task->time_remaining = !is_null($task->end_date) ? daysDifference($task->end_date) : null;
            $task->is_done = ($task->status_id == TaskStatusSetting::DONE_STATUS);
            $task->start_date = !is_null($task->start_date) ? date('d/m/Y', strtotime($task->start_date)) : "";
            $task->end_date = !is_null($task->end_date) ? date('d/m/Y', strtotime($task->end_date)) : "";
            $task->assignee_img = $task->assignee_img ? \Storage::url($task->assignee_img) : '';
            $task->createdBy_img = $task->createdBy_img ? \Storage::url($task->createdBy_img) : '';
            if ($task->parent_id === null) {
                array_push($task->actions, [
                    'icon'   => 'icon-add',
                    'index'  => 'createSubTask',
                    'title'  => trans('admin::app.task.create.subTask'),
                    'method' => 'POST',
                    'url'    => route('admin.tasks.edit', $task->id),
                    'parentId' => $task->id,
                ]);
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
