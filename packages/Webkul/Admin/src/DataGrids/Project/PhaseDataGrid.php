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
    public function __construct()
    {

    }

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $projectId = basename(request()->url());
        $queryBuilder = DB::table('phases')
            ->leftJoin('projects', 'projects.id', '=', 'phases.project_id')
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
        ]);

        $this->addColumn([
            'index'      => 'project_name',
            'label'      => trans('admin::app.phase.index.datagrid.project'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'start_date',
            'label'      => trans('admin::app.phase.index.datagrid.start_date'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return date('d/m/Y', strtotime($row->start_date));
            },
        ]);

        $this->addColumn([
            'index'      => 'end_date',
            'label'      => trans('admin::app.phase.index.datagrid.end_date'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return date('d/m/Y', strtotime($row->end_date));
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
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
         if (bouncer()->hasPermission('project.view')) {
//             $this->addAction([
//                 'icon'   => 'icon-eye',
//                 'title'  => trans('admin::app.project.view.title'),
//                 'method' => 'GET',
//                 'url'    => fn ($row) => route('admin.projects.view', $row->id),
//             ]);
             $this->addAction([
                 'index'  => 'edit',
                 'icon'   => 'icon-edit',
                 'title'  => trans('admin::app.phase.edit.title'),
                 'method' => 'GET',
                 'url'    => fn ($row) => route('admin.phases.edit', $row->id),
             ]);
         }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void
    {
        
    }
}
