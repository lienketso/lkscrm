<?php

namespace Webkul\Admin\Http\Controllers\Project;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\DataGrids\Project\ProjectDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Project\Repositories\ProjectRepository;
use Webkul\User\Repositories\UserRepository;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepository $projectRepo,
        protected UserRepository    $userRepo,
    )
    {
    }

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(ProjectDataGrid::class)->process();
        }
        $leaders = $this->userRepo->getLeaderListSelectInput(null);
        return view('admin::projects.index', compact('leaders'));
    }

    public function create()
    {
        try {
            $model = $this->projectRepo->makeModel();
            $leaders = $this->userRepo->getLeaderListSelectInput(null);
            $members = $this->userRepo->getMemberByLeader(1);
            return view('admin::projects.form', compact('leaders', 'model', 'members'));
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.project.create-failed'));
            return redirect()->route('admin.projects.index');
        }
    }

    public function store(Request $request)
    {
        try {
            $formData = $request->only(['title', 'description', 'leader_id', 'start_date', 'end_date', 'status']);
            foreach ($formData as $key => $data)
            {
                if (is_null($data) || $data == ''){
                    unset($formData[$key]);
                }
            }
            DB::beginTransaction();
            $rs = $this->projectRepo->create($formData);
            if (!$rs) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.project.create-failed'),
                ], 500);
            }

            if (count($request->input('member_id', [])))
            {
                $rs->members()->attach($request->input('member_id'));
            }

            DB::commit();
            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.project.create-success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.project.create-failed'),
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $model = $this->projectRepo->findOrFail($id);
            return new JsonResponse([
                'data' => $model,
                'selectedMember' => $model->members->pluck('id')->all(),
                'message' => null,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.project.update-failed'),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = $this->projectRepo->findOrFail($id);
            $formData = $request->only(['title', 'description', 'leader_id', 'start_date', 'end_date', 'status']);
            foreach ($formData as $key => $data)
            {
                if (is_null($data) || $data == ''){
                    unset($formData[$key]);
                }
            }
            DB::beginTransaction();
            $rs = $this->projectRepo->update($formData, $model->id);
            if (!$rs) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.project.update-failed'),
                ], 500);
            }

            if (count($request->input('member_id', [])))
            {
                $rs->members()->sync($request->input('member_id'));
            }

            DB::commit();
            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.project.update-success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.project.update-failed'),
            ], 500);
        }
    }

    public function getMemberByLeader(Request $request)
    {
        try {
            $leaderId = $request->query('leader_id');
            $members = $this->userRepo->getMemberByLeader($leaderId);
            return new JsonResponse([
                'data' => $members
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.an_error_occurred'),
            ], 500);
        }
    }
}
