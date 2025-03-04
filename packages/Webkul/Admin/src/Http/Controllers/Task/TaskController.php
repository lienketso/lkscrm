<?php

namespace Webkul\Admin\Http\Controllers\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\DataGrids\Task\TaskDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Project\Repositories\PhaseRepository;
use Webkul\Project\Repositories\ProjectRepository;
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
    )
    {
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return datagrid(TaskDataGrid::class)->process();
        }

        $projects = $this->projectRepo->getProjectListSelectInput();
        $taskPriority = $this->prioritySettingRepo->getTaskPrioritySettingInput();
        $taskStatus = $this->taskStatusSettingRepo->getTaskStatusSettingInput();
        $taskCategory = $this->taskCategorySettingRepo->getTaskCategorySettingInput();

        return view('admin::tasks.index', compact('projects', 'taskPriority', 'taskStatus', 'taskCategory'));
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
            DB::beginTransaction();
            $rs = $this->taskRepo->create($formData);
            if (!$rs) {
                session()->flash('error', trans('admin::app.task.create-failed'));

                return redirect()->route('admin.tasks.index');
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
            $model = $this->taskRepo->findOrFail($id);

            return new JsonResponse([
                'data' => $model,
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
            $formData = $request->only(['title', 'assignee_id', 'description', 'category_id', 'priority_id', 'project_id', 'phase_id', 'start_date', 'end_date', 'status_id', 'parent_id']);
            DB::beginTransaction();
            $rs = $this->taskRepo->update($formData, $model->id);
            if (!$rs) {
                session()->flash('error', trans('admin::app.task.update-failed'));

                return redirect()->route('admin.tasks.index');
            }

            DB::commit();
            session()->flash('success', trans('admin::app.task.update-success'));

            return redirect()->route('admin.tasks.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', trans('admin::app.task.update-failed'));

            return redirect()->route('admin.tasks.index');
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
            $users = $this->userRepo->getMemberByLeader($project->leader_id);

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
            $parentTask = $this->taskRepo->getTaskListByFilters(['project_id' => $projectId]);

            return new JsonResponse([
                'data' => $parentTask,
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
}
