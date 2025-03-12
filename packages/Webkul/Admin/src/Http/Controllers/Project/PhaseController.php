<?php

namespace Webkul\Admin\Http\Controllers\Project;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\DataGrids\Project\PhaseDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Project\Repositories\PhaseRepository;
use Webkul\Project\Repositories\ProjectRepository;

class PhaseController extends Controller
{

    public function __construct(
        protected PhaseRepository $phaseRepo,
        protected ProjectRepository $projectRepo
    )
    {
    }

    public function index($projectId)
    {
        if (request()->ajax()) {
            return datagrid(PhaseDataGrid::class)->process();
        }
        $project = $this->projectRepo->find($projectId);
        if (!$project) {
            session()->flash('error', trans('admin::app.project.not-found'));
            return redirect()->route('admin.projects.index');
        }
        return view('admin::phases.index', compact('project'));
    }

    public function create()
    {
        try {
            $model = $this->projectRepo->makeModel();
            $projects = $this->projectRepo->getProjectListSelectInput();
            return view('admin::phases.form', compact('projects', 'model'));
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.project.create-failed'));
            return redirect()->route('admin.projects.index');
        }
    }

    public function store(Request $request)
    {
        try {
            $formData = $request->only(['title', 'description', 'project_id', 'start_date', 'end_date', 'status']);
            foreach ($formData as $key => $data)
            {
                if (is_null($data) || $data == ''){
                    unset($formData[$key]);
                }
            }
            $rs = $this->phaseRepo->create($formData);
            if (!$rs) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.phase.create-failed'),
                ], 500);
            }

            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.phase.create-success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.phase.create-failed'),
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $model = $this->phaseRepo->findOrFail($id);
            return new JsonResponse([
                'data' => $model,
                'message' => null,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.phase.update-failed'),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = $this->phaseRepo->findOrFail($id);
            $formData = $request->only(['title', 'description', 'project_id', 'start_date', 'end_date', 'status']);
            foreach ($formData as $key => $data)
            {
                if (is_null($data) || $data == ''){
                    unset($formData[$key]);
                }
            }
            $rs = $this->phaseRepo->update($formData, $model->id);
            if (!$rs) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.phase.update-failed'),
                ], 500);
            }
            return new JsonResponse([
                'data' => $rs,
                'message' => trans('admin::app.phase.update-success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse([
                'data' => null,
                'message' => trans('admin::app.phase.update-failed'),
            ], 500);
        }
    }
}
