<?php

namespace Webkul\Admin\DataGrids\Project;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\Project\Models\Phase;

class PhaseDataGrid extends DataGrid
{
    /**
     * Create data grid instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $projectId = basename(request()->url());
        $queryBuilder = DB::table('phases')
            ->leftJoin('projects', 'projects.id', '=', 'phases.project_id')
            ->leftJoin('users as createdBy', 'phases.created_by', '=', 'createdBy.id')
            ->whereNull('phases.deleted_at')
            ->where('project_id', '=', $projectId);

        return $queryBuilder->select(
            'projects.id as project_id',
            'projects.title as project_name',
            'phases.id',
            'phases.title',
            'phases.start_date',
            'phases.end_date',
            'phases.status',
            'phases.created_at',
            'createdBy.name as createdBy_name',
            'createdBy.image as createdBy_img',
        )->orderBy('created_at', 'DESC');
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.phase.index.datagrid.title'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'custom_grid' => '2fr',
        ]);

        $this->addColumn([
            'index'      => 'project_name',
            'label'      => trans('admin::app.phase.index.datagrid.project'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'custom_grid' => '2fr',
        ]);

        $this->addColumn([
            'index'      => 'start_date',
            'label'      => trans('admin::app.phase.index.datagrid.start_date'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return $row->start_date ? date('d/m/Y', strtotime($row->start_date)) : '';
            },
        ]);

        $this->addColumn([
            'index'      => 'end_date',
            'label'      => trans('admin::app.phase.index.datagrid.end_date'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return $row->end_date ? date('d/m/Y', strtotime($row->end_date)) : '';
            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.phase.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                $status = Phase::STATUS[$row->status];
                $statusCssClass = $row->status == Phase::ACTIVE ? 'label-active' : 'label-inactive';

                return <<<HTML
                        <span class="$statusCssClass"
                            >
                                $status
                            </span>
                    HTML;
            },
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.phase.index.datagrid.created-at'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return date('d/m/Y H:i:s', strtotime($row->created_at));
            },
        ]);

//        $this->addColumn([
//            'index'      => 'createdBy',
//            'label'      => trans('admin::app.task.index.datagrid.created_by'),
//            'type'       => 'string',
//            'sortable'   => false,
//            'filterable' => true,
//        ]);

        $this->addColumn([
            'index'      => 'createdBy_img',
            'label'      => trans('admin::app.task.index.datagrid.created_by'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return $row->createdBy_img ? \Storage::url($row->createdBy_img) : '';
            },
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
        $projectId = basename(request()->url());
        if (bouncer()->hasPermission('project.view')) {
            $this->addAction([
                'index'  => 'listTask',
                'icon'   => 'icon-list',
                'title'  => trans('admin::app.task.list'),
                'method' => 'GET',
                'url'    => fn ($row) => route('admin.tasks.index', ['project_id' => $projectId, 'phase_id' => $row->id]),
            ]);
            $this->addAction([
                'index'  => 'edit',
                'icon'   => 'icon-edit',
                'title'  => trans('admin::app.phase.edit.title'),
                'method' => 'GET',
                'url'    => fn ($row) => route('admin.phases.edit', $row->id),
            ]);

            $this->addAction([
                'index'  => 'delete',
                'icon'   => 'icon-delete',
                'title'  => trans('admin::app.phase.delete.title'),
                'method' => 'DELETE',
                'url'    => fn ($row) => route('admin.phases.delete', $row->id),
            ]);
        }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void {}
}
