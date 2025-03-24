<?php

namespace Webkul\Admin\Http\Controllers\Project;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\DataGrids\Project\ProjectDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Project\Models\Project;
use Webkul\Project\Repositories\ProjectRepository;
use Webkul\User\Repositories\GroupRepository;
use Webkul\User\Repositories\UserRepository;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepository $projectRepo,
        protected UserRepository    $userRepo,
        protected GroupRepository   $groupRepo
    )
    {
    }

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(ProjectDataGrid::class)->process();
        }
        $leaders = $this->userRepo->getLeaderListSelectInput(null);
        $groups = $this->groupRepo->all();
        return view('admin::projects.index', compact('leaders', 'groups'));
    }

    public function store(Request $request)
    {
        try {
            $formData = $request->only(['title', 'description', 'leader_id', 'start_date', 'end_date', 'status', 'member_type', 'group_id']);
            foreach ($formData as $key => $data)
            {
                if (is_null($data) || $data == ''){
                    unset($formData[$key]);
                }
            }
            $formData['created_by'] = auth()->id();
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
            if (!auth()->user()->canAddAndDeleteProjectDataById($id)) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.project.forbidden'),
                ], 403);
            }
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
            if (!auth()->user()->canAddAndDeleteProjectDataById($id)) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.project.forbidden'),
                ], 403);
            }
            $model = $this->projectRepo->findOrFail($id);
            $formData = $request->only(['title', 'description', 'leader_id', 'start_date', 'end_date', 'status', 'member_type', 'group_id']);
            foreach ($formData as $key => $data)
            {
                if (is_null($data) || $data == ''){
                    unset($formData[$key]);
                }
            }
            if ($formData['member_type'] == Project::ALL_MEMBER_TYPE){
                $formData['group_id'] = null;
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
            $user = $this->userRepo->with('groups')->find($leaderId);
            if (!$user) {
                return new JsonResponse([
                    'data' => []
                ], 200);
            }
            $groupId = $request->query('group_id');
            $memberType = $request->query('member_type');
            $members = $this->userRepo->getMemberByLeader($groupId, $memberType, $leaderId);
            return new JsonResponse([
                'data' => $members
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.an_error_occurred'),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            if (!auth()->user()->canAddAndDeleteProjectDataById($id)) {
                return new JsonResponse([
                    'data' => null,
                    'message' => trans('admin::app.project.forbidden'),
                ], 403);
            }
            $model = $this->projectRepo->findOrFail($id);

            $rs = $model->delete();
            if(!$rs)
            {
                return new JsonResponse([
                    'message' => trans('admin::app.project.destroy-failed'),
                ], 500);
            }
            return new JsonResponse([
                'message' => trans('admin::app.project.destroy-success'),
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.project.destroy-failed'),
            ], 500);
        }
    }
}
