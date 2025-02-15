<?php

namespace Webkul\Admin\Http\Controllers\Project;

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

        return view('admin::projects.index');
    }

    public function create()
    {
        try {
            $model = $this->projectRepo->makeModel();
            $leaders = $this->userRepo->getLeaderListSelectInput();
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
            $formData = $request->only(['title', 'description', 'leader_id', 'member_id']);
            DB::beginTransaction();
            $rs = $this->projectRepo->create($formData);
            if (!$rs) {
                session()->flash('error', trans('admin::app.project.create-failed'));
                return redirect()->route('admin.projects.index');
            }

            if (count($request->input('member_id', [])))
            {
                $rs->members()->attach($request->input('member_id', []));
            }

            DB::commit();
            session()->flash('success', trans('admin::app.project.create-success'));
            return redirect()->route('admin.projects.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', trans('admin::app.project.create-failed'));
            return redirect()->route('admin.projects.index');
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
}
