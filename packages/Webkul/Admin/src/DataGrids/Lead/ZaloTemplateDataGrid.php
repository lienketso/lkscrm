<?php

namespace Webkul\Admin\DataGrids\Lead;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webkul\Lead\Repositories\PipelineRepository;
use Webkul\Lead\Repositories\SourceRepository;
use Webkul\Lead\Repositories\StageRepository;
use Webkul\Lead\Repositories\TypeRepository;
use Webkul\Tag\Repositories\TagRepository;
use Webkul\User\Repositories\UserRepository;

class ZaloTemplateDataGrid extends DataGrid
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
        $queryBuilder = DB::table('zalo_templates');

        if (! is_null(request()->input('id'))) {
            $queryBuilder->where('id', request()->input('id'));
        }

        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.zalo.columns.id'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'template_id',
            'label'      => trans('admin::app.zalo.columns.template_id'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'template_name',
            'label'      => trans('admin::app.zalo.columns.template_name'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.zalo.columns.status'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'price',
            'label'      => trans('admin::app.zalo.columns.price'),
            'type'       => 'string',
            'sortable'   => true,
            'filterable' => true,
        ]);

        /*$this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.leads.index.datagrid.id'),
            'type'       => 'integer',
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'              => 'sales_person',
            'label'              => trans('admin::app.leads.index.datagrid.sales-person'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'searchable_dropdown',
            'filterable_options' => [
                'repository' => UserRepository::class,
                'column'     => [
                    'label' => 'name',
                    'value' => 'name',
                ],
            ],
        ]);

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.leads.index.datagrid.subject'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'              => 'lead_source_name',
            'label'              => trans('admin::app.leads.index.datagrid.source'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => $this->sourceRepository->all(['name as label', 'id as value'])->toArray(),
        ]);

        $this->addColumn([
            'index'      => 'lead_value',
            'label'      => trans('admin::app.leads.index.datagrid.lead-value'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => true,
            'closure'    => fn ($row) => core()->formatBasePrice($row->lead_value, 2),
        ]);

        $this->addColumn([
            'index'              => 'lead_type_name',
            'label'              => trans('admin::app.leads.index.datagrid.lead-type'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => $this->typeRepository->all(['name as label', 'id as value'])->toArray(),
        ]);

        $this->addColumn([
            'index'              => 'tag_name',
            'label'              => trans('admin::app.leads.index.datagrid.tag-name'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'searchable_dropdown',
            'closure'            => fn ($row) => $row->tag_name ?? '--',
            'filterable_options' => [
                'repository' => TagRepository::class,
                'column'     => [
                    'label' => 'name',
                    'value' => 'name',
                ],
            ],
        ]);

        $this->addColumn([
            'index'              => 'person_name',
            'label'              => trans('admin::app.leads.index.datagrid.contact-person'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'searchable_dropdown',
            'filterable_options' => [
                'repository' => \Webkul\Contact\Repositories\PersonRepository::class,
                'column'     => [
                    'label' => 'name',
                    'value' => 'name',
                ],
            ],
            'closure'    => function ($row) {
                $route = route('admin.contacts.persons.view', $row->person_id);

                return "<a class=\"text-brandColor transition-all hover:underline\" href='".$route."'>".$row->person_name.'</a>';
            },
        ]);

        $this->addColumn([
            'index'              => 'stage',
            'label'              => trans('admin::app.leads.index.datagrid.stage'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => $this->pipeline->stages->pluck('name', 'id')
                ->map(function ($name, $id) {
                    return ['value' => $id, 'label' => $name];
                })
                ->values()
                ->all(),
        ]);

        $this->addColumn([
            'index'      => 'rotten_lead',
            'label'      => trans('admin::app.leads.index.datagrid.rotten-lead'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => false,
            'closure'    => function ($row) {
                if (! $row->rotten_lead) {
                    return trans('admin::app.leads.index.datagrid.no');
                }

                if (in_array($row->stage_code, ['won', 'lost'])) {
                    return trans('admin::app.leads.index.datagrid.no');
                }

                return trans('admin::app.leads.index.datagrid.yes');
            },
        ]);

        $this->addColumn([
            'index'           => 'expected_close_date',
            'label'           => trans('admin::app.leads.index.datagrid.expected-close-date'),
            'type'            => 'date',
            'searchable'      => false,
            'sortable'        => true,
            'filterable'      => true,
            'filterable_type' => 'date_range',
            'closure'         => function ($row) {
                if (! $row->expected_close_date) {
                    return '--';
                }

                return $row->expected_close_date;
            },
        ]);

        $this->addColumn([
            'index'           => 'created_at',
            'label'           => trans('admin::app.leads.index.datagrid.created-at'),
            'type'            => 'date',
            'searchable'      => false,
            'sortable'        => true,
            'filterable'      => true,
            'filterable_type' => 'date_range',
        ]);
        */
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
        // if (bouncer()->hasPermission('leads.view')) {
            $this->addAction([
                'icon'   => 'icon-eye',
                'title'  => trans('admin::app.leads.index.datagrid.view'),
                'method' => 'GET',
                'url'    => fn ($row) => route('admin.leads.view', $row->id),
            ]);
        // }
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions(): void
    {
        
    }
}
