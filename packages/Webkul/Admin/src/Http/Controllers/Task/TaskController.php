<?php

namespace Webkul\Admin\Http\Controllers\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\DataGrids\Task\TaskDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Project\Repositories\PhaseRepository;
use Webkul\Project\Repositories\ProjectRepository;
use Webkul\Task\Repositories\TaskCommentRepository;
use Webkul\Task\Repositories\TaskRepository;
use Webkul\TaskCategorySetting\Repositories\TaskCategorySettingRepository;
use Webkul\TaskPrioritySetting\Repositories\TaskPrioritySettingRepository;
use Webkul\TaskStatusSetting\Models\TaskStatusSetting;
use Webkul\TaskStatusSetting\Repositories\TaskStatusSettingRepository;
use Webkul\User\Repositories\UserRepository;

class TaskController extends Controller
{
    public function __construct(
        protected TaskPrioritySettingRepository $prioritySettingRepo,
        protected TaskStatusSettingRepository   $taskStatusSettingRepo,
        protected TaskCategorySettingRepository $taskCategorySettingRepo,
        protected ProjectRepository             $projectRepo,
        protected UserRepository                $userRepo,
        protected PhaseRepository               $phaseRepo,
        protected TaskRepository                $taskRepo,
        protected TaskCommentRepository         $taskCommentRepo,
    )
    {
    }

    public function index(Request $request)
    {
        if (!$request->get('project_id') || !$request->get('phase_id')) {
            return redirect(route('admin.projects.index'));
        }
        if (request()->ajax()) {
            return datagrid(TaskDataGrid::class)->process();
        }

        $project = $this->projectRepo->find($request->get('project_id'));
        if (!auth()->user()->canProjectAccess($project->id)) {
            session()->flash('error', trans('admin::app.project.forbidden'));

            return redirect()->route('admin.projects.index');
        }
        $phase = $this->phaseRepo->findOneWhere(['project_id' => $request->get('project_id'), 'id' => $request->get('phase_id')]);
        if (!$project || !$phase) {
            return redirect(route('admin.projects.index'));
        }
        $userByProject = $this->userRepo->getUserSupport($project->id);
        $taskPriority = $this->prioritySettingRepo->getTaskPrioritySettingInput();
        $taskStatus = $this->taskStatusSettingRepo->getTaskStatusSettingInput();
        $taskCategory = $this->taskCategorySettingRepo->getTaskCategorySettingInput();

        return view('admin::tasks.index', compact('project', 'phase', 'taskPriority', 'taskStatus', 'taskCategory', 'userByProject'));
    }

    public function create()
    {
        try {
            $model = $this->taskRepo->makeModel();
            $projecs = $this->projectRepo->getProjectListSelectInput();
            $users = $this->userRepo->getMemberByLeader(null);
            $phases = $this->phaseRepo->getPhaseByProjectInput(null);
            $taskPriority = $this->prioritySettingRepo->getTaskPrioritySettingInput();
            $taskStatus = $this->taskStatusSettingRepo->getTaskStatusSettingInput();

            return view('admin::tasks.form', compact('projecs', 'model', 'taskPriority', 'phases', 'users', 'taskStatus'));
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.project.create-failed'));

            return redirect()->route('admin.projects.index');
        }
    }

    public function store(Request $request)
    {
        try {
            $formData = $request->only(['title', 'assignee_id', 'description', 'category_id', 'priority_id', 'project_id', 'phase_id', 'start_date', 'end_date', 'parent_id']);
            $formData['status_id'] = TaskStatusSetting::DEFAULT_STATUS;
            $formData['created_by'] = auth()->id();
            foreach ($formData as $key => $data) {
                if (is_null($data) || $data == '') {
                    unset($formData[$key]);
                }
            }
            DB::beginTransaction();
            $rs = $this->taskRepo->create($formData);
            if (!$rs) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.create-failed'),
                ], 500);
            }

            if (count($request->input('support_id', []))) {
                $rs->userSupport()->attach($request->input('support_id'));
            }

            DB::commit();

            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.task.create-success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.task.create-failed'),
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $model = $this->taskRepo->with(['userSupport', 'subTasks'])->findOrFail($id);
            if (!auth()->user()->canEditAndDeleteTaskById($model->project_id, $id)) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.forbidden'),
                ], 403);
            }

            return new JsonResponse([
                'data' => $model,
                'selectedUserSp' => $model->userSupport->pluck('id')->all(),
                'canUpdateParentTask' => (count($model->subTasks ?? []) == 0),
                'message' => null,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.task.update-failed'),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = $this->taskRepo->findOrFail($id);
            if (!auth()->user()->canEditAndDeleteTaskById($model->project_id, $id)) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.forbidden'),
                ], 403);
            }
            $formData = $request->only(['title', 'assignee_id', 'description', 'category_id', 'priority_id', 'project_id', 'phase_id', 'start_date', 'end_date', 'status_id', 'parent_id']);
            foreach ($formData as $key => $data) {
                if (is_null($data) || $data == '') {
                    unset($formData[$key]);
                }
            }

            DB::beginTransaction();
            $rs = $this->taskRepo->update($formData, $model->id);
            if (!$rs) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.update-failed'),
                ], 500);
            }

            if (count($request->input('support_id', []))) {
                $rs->userSupport()->sync($request->input('support_id'));
            }


            DB::commit();

            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.task.update-success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.task.update-failed'),
            ], 500);
        }
    }

    public function getPhaseByProjectInput(Request $request)
    {
        try {
            $phases = $this->phaseRepo->getPhaseByProjectInput($request->project_id);

            return new JsonResponse([
                'data' => $phases,
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.an_error_occurred'),
            ], 500);
        }
    }

    public function getAssignByProjectInput(Request $request)
    {
        try {
            $projectId = $request->get('project_id');
            $project = $this->projectRepo->find($projectId);
            $users = $this->userRepo->getAssignByProject($project->id);

            return new JsonResponse([
                'data' => $users,
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.an_error_occurred'),
            ], 500);
        }
    }

    public function getParentTaskByProjectInput(Request $request)
    {
        try {
            $projectId = $request->get('project_id');
            $phase_id = $request->get('phase_id');
            $parentTask = $this->taskRepo->getTaskListByFilters(['project_id' => $projectId, 'phase_id' => $phase_id]);

            return new JsonResponse([
                'data' => $parentTask,
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.an_error_occurred'),
            ], 500);
        }
    }

    public function getUserSupportInput(Request $request)
    {
        try {
            $assigneeId = $request->query('assignee_id');
            $projectId = $request->query('project_id');
            $project = $this->projectRepo->find($projectId);
            if (!$project) {
                return new JsonResponse([
                    'data' => []
                ], 200);
            }
            $members = $this->userRepo->getAssignByProject($project->id, $assigneeId);
            return new JsonResponse([
                'data' => $members
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.an_error_occurred'),
            ], 500);
        }
    }

    public function getCommentByTaskId(Request $request)
    {
        try {
            $taskId = $request->query('task_id');
            $taskCommentList = $this->taskCommentRepo->getCommentByTaskId($taskId);
            $arrRs = [];
            foreach ($taskCommentList as $item) {
                $arrRs[] = [
                    'id' => $item->id,
                    'task_id' => $item->task?->id,
                    'user' => $item?->user,
                    'content' => $item->content,
                    'created_at' => date('d-m-Y H:i', strtotime($item->created_at)),
                    'actions' => [
                        [
                            'icon'   => 'icon-edit',
                            'index'  => 'edit',
                            'title'  => trans('admin::app.task.comment.edit'),
                            'method' => 'GET',
                            'url'    => route('admin.tasks.editComment', $item->id)
                        ],[
                            'index'  => 'delete',
                            'icon'   => 'icon-delete',
                            'title'  => trans('admin::app.task.comment.delete'),
                            'method' => 'DELETE',
                            'url'    => route('admin.tasks.deleteComment', $item->id),
                        ]
                    ]
                ];
            }
            return new JsonResponse([
                'data' => $arrRs
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.an_error_occurred'),
            ], 500);
        }
    }

    public function changeTaskStatus(Request $request)
    {
        try {
            $taskIds = $request->input('indices', []);
            $checkCanDelete = true;
            foreach ($taskIds as $taskId) {
                $task = $this->taskRepo->find($taskId);
                if (!auth()->user()->canEditAndDeleteTaskById($task->project_id, $taskId)) {
                    $checkCanDelete = false;
                }
            }
            if (!$checkCanDelete) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.forbidden'),
                ], 403);
            }
            DB::beginTransaction();
            $rs = $this->taskRepo->makeModel()->whereIn('id', $taskIds)->update(['status_id' => $request->value]);
            DB::commit();

            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.project.update-status-success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return new JsonResponse([
                'message' => trans('admin::app.project.update-status-failed'),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $model = $this->taskRepo->findOrFail($id);
            if (!auth()->user()->canEditAndDeleteTaskById($model->project_id, $id)) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.forbidden'),
                ], 403);
            }
            $rs = $model->delete();
            if (!$rs) {
                return new JsonResponse([
                    'message' => trans('admin::app.task.destroy-failed'),
                ], 500);
            }

            return new JsonResponse([
                'message' => trans('admin::app.task.destroy-success'),
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.task.destroy-failed'),
            ], 500);
        }
    }

    public function storeComment(Request $request)
    {
        try {
            if (!auth()->user()->canEditAndDeleteTaskById($request->project_id, $request->task_id)) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.comment.forbidden_create'),
                ], 403);
            }
            $formData = $request->only(['content', 'task_id']);
            $formData['user_id'] = auth()->id();
            $rs = $this->taskCommentRepo->create($formData);
            if (!$rs) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.comment.create-failed'),
                ], 500);
            }

            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.task.comment.create-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.task.comment.create-failed'),
            ], 500);
        }
    }

    public function editComment($id)
    {
        try {
            $model = $this->taskCommentRepo->find($id);
            if ($model->user_id != auth()->id()) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.comment.forbidden'),
                ], 403);
            }

            return new JsonResponse([
                'data' => $model
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.task.comment.update-failed'),
            ], 500);
        }
    }

    public function updateComment(Request $request)
    {
        try {
            $model = $this->taskCommentRepo->findOrFail($request->id);
            if ($model->user_id != auth()->id()) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.comment.forbidden'),
                ], 403);
            }
            $formData = $request->only(['content']);
            $rs = $this->taskCommentRepo->update($formData, $model->id);
            if (!$rs) {
                return new JsonResponse([
                    'message' => trans('admin::app.task.comment.update-failed'),
                ], 500);
            }

            return new JsonResponse([
                'message' => trans('admin::app.task.comment.update-success'),
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.task.comment.update-failed'),
            ], 500);
        }
    }

    public function deleteComment($id)
    {
        try {
            $model = $this->taskCommentRepo->findOrFail($id);
            if ($model->user_id != auth()->id()) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.task.comment.forbidden'),
                ], 403);
            }
            $rs = $model->delete();
            if (!$rs) {
                return new JsonResponse([
                    'message' => trans('admin::app.task.comment.destroy-failed'),
                ], 500);
            }

            return new JsonResponse([
                'message' => trans('admin::app.task.comment.destroy-success'),
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.task.comment.destroy-failed'),
            ], 500);
        }
    }
}
