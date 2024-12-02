<?php

namespace Webkul\Admin\DataGrids\Lead;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\Lead\Models\Campaign;
use Webkul\Lead\Models\CampaignSchedule;

class CampaignDataGrid extends DataGrid
{
    /**
     * Create data grid instance.
     *
     * @return void
     */
    public function __construct() 
    {
        // do something
    }

    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder(): Builder
    {
        $queryBuilder = DB::table('campaigns');
        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.campaign.index.datagrid.id'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.campaign.index.datagrid.name'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'description',
            'label'      => trans('admin::app.campaign.index.datagrid.description'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.campaign.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return Campaign::STATUS[$row->status];
            },
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
        // if (bouncer()->hasPermission('leads.view')) {
            // $this->addAction([
            //     'icon'   => 'icon-eye',
            //     'title'  => trans('admin::app.campaign.view.title'),
            //     'method' => 'GET',
            //     'url'    => fn ($row) => route('admin.campaign.view', $row->id),
            // ]);
            // $this->addAction([
            //     'icon'   => 'icon-edit',
            //     'title'  => trans('admin::app.campaign.edit.title'),
            //     'method' => 'GET',
            //     'url'    => fn ($row) => route('admin.campaign.edit', $row->id),
            // ]);
        // }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void
    {
        
    }
}
