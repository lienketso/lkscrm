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
use Webkul\TaskPrioritySetting\Repositories\TaskPrioritySettingRepository;
use Webkul\TaskStatusSetting\Models\TaskStatusSetting;
use Webkul\User\Repositories\UserRepository;

class TaskController extends Controller
{
    public function __construct(
        protected ProjectRepository $projectRepo,
        protected UserRepository    $userRepo,
        protected TaskPrioritySettingRepository $prioritySettingRepo,
        protected PhaseRepository $phaseRepo,
        protected TaskRepository $taskRepo,
    )
    {
    }

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(TaskDataGrid::class)->process();
        }
        return view('admin::tasks.index');
    }

    public function create()
    {
        try {
            $model = $this->projectRepo->makeModel();
            $projecs = $this->projectRepo->getProjectListSelectInput();
            $users = $this->userRepo->getMemberByLeader(null);
            $phases = $this->phaseRepo->getPhaseByProjectInput(null);
            $taskPriority = $this->prioritySettingRepo->getTaskPrioritySettingInput();
            return view('admin::tasks.form', compact('projecs', 'model', 'taskPriority', 'phases', 'users'));
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.project.create-failed'));
            return redirect()->route('admin.projects.index');
        }
    }

    public function store(Request $request)
    {
        try {
            $formData = $request->only(['title', 'assignee_id', 'description', 'step', 'priority_id', 'project_id', 'phase_id', 'start_date', 'end_date']);
            $formData['status_id'] = TaskStatusSetting::DEFAULT_STATUS;
            DB::beginTransaction();
            $rs = $this->taskRepo->create($formData);
            if (!$rs) {
                session()->flash('error', trans('admin::app.task.create-failed'));
                return redirect()->route('admin.tasks.index');
            }

            DB::commit();
            session()->flash('success', trans('admin::app.task.create-success'));
            return redirect()->route('admin.tasks.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', trans('admin::app.task.create-failed'));
            return redirect()->route('admin.tasks.index');
        }
    }

    public function edit($id)
    {
        try {
            $model = $this->projectRepo->findOrFail($id);
            $leaders = $this->userRepo->getLeaderListSelectInput();
            $members = $this->userRepo->getMemberByLeader(1);
            return view('admin::projects.form', compact('leaders', 'model', 'members'));
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.project.update-failed'));
            return redirect()->route('admin.projects.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = $this->projectRepo->findOrFail($id);
            $formData = $request->only(['title', 'description', 'leader_id']);
            DB::beginTransaction();
            $rs = $this->projectRepo->update($formData, $model->id);
            if (!$rs) {
                session()->flash('error', trans('admin::app.project.update-failed'));
                return redirect()->route('admin.projects.index');
            }

            if (count($request->input('member_id', [])))
            {
                $rs->members()->sync($request->input('member_id', []));
            }

            DB::commit();
            session()->flash('success', trans('admin::app.project.update-success'));
            return redirect()->route('admin.projects.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', trans('admin::app.project.update-failed'));
            return redirect()->route('admin.projects.index');
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
}
