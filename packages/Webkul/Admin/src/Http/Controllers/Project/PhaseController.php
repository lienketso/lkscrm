<?php

namespace Webkul\Admin\Http\Controllers\Project;

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

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(PhaseDataGrid::class)->process();
        }

        return view('admin::phases.index');
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
            $formData = $request->only(['title', 'description', 'project_id', 'start_date', 'end_date']);
            DB::beginTransaction();
            $rs = $this->phaseRepo->create($formData);
            if (!$rs) {
                session()->flash('error', trans('admin::app.phase.create-failed'));
                return redirect()->route('admin.phases.index');
            }

            DB::commit();
            session()->flash('success', trans('admin::app.phase.create-success'));
            return redirect()->route('admin.phases.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', trans('admin::app.phase.create-failed'));
            return redirect()->route('admin.phases.index');
        }
    }
}
