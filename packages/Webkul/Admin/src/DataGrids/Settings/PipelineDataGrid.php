<?php

namespace Webkul\Admin\DataGrids\Settings;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\Lead\Models\Pipeline;

class PipelineDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $queryBuilder = DB::table('lead_pipelines')
            ->addSelect(
                'lead_pipelines.id',
                'lead_pipelines.name',
                'lead_pipelines.rotten_days',
                'lead_pipelines.type',
                'lead_pipelines.is_default',
            );

        $this->addFilter('id', 'lead_pipelines.id');

        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'    => 'id',
            'label'    => trans('admin::app.settings.pipelines.index.datagrid.id'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.custom-setting.pipelines.name'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'    => 'rotten_days',
            'label'    => trans('admin::app.custom-setting.pipelines.rotten-days'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'type',
            'label'    => trans('admin::app.custom-setting.pipelines.type'),
            'type'     => 'string',
            'sortable' => false,
            'closure'    => fn ($value) => $value->type ? Pipeline::ARR_TYPE[$value->type] : '',
        ]);

        $this->addColumn([
            'index'      => 'is_default',
            'label'      => trans('admin::app.custom-setting.pipelines.is-default'),
            'type'       => 'boolean',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
            'closure'    => fn ($value) => trans('admin::app.settings.pipelines.index.datagrid.'.($value->is_default ? 'yes' : 'no')),
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
        if (bouncer()->hasPermission('settings.lead.pipelines.edit')) {
            $this->addAction([
                'index'  => 'edit',
                'icon'   => 'icon-edit',
                'title'  => trans('admin::app.settings.pipelines.index.datagrid.edit'),
                'method' => 'GET',
                'url'    => fn ($row) => route('admin.settings.pipelines.edit', $row->id),
            ]);
        }

        if (bouncer()->hasPermission('settings.lead.pipelines.delete')) {
            $this->addAction([
                'index'  => 'delete',
                'icon'   => 'icon-delete',
                'title'  => trans('admin::app.settings.pipelines.index.datagrid.delete'),
                'method' => 'DELETE',
                'url'    => fn ($row) => route('admin.settings.pipelines.delete', $row->id),
            ]);
        }
    }
}
