<?php

namespace Webkul\Admin\DataGrids\Project;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Webkul\DataGrid\DataGrid;
use Webkul\Project\Models\Project;
use Webkul\User\Models\User;

class ProjectDataGrid extends DataGrid
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
        $queryBuilder = DB::table('projects')
            ->leftJoin('users', 'users.id', '=', 'projects.leader_id')
            ->whereNull('projects.deleted_at')
            ->select(
                'users.id as leader_id',
                'users.name as leader_name',
                'users.image as leader_image',
                'projects.id',
                'projects.title',
                'projects.description',
                'projects.status',
                'projects.member_type',
                'projects.created_at',
                'projects.start_date',
                'projects.end_date',
            )->orderBy('created_at', 'DESC');
        return $queryBuilder;
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns(): void
    {

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.project.index.datagrid.title'),
            'type'       => 'string',
            'custom_grid' => '2fr',
            'sortable'   => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'description',
            'label'      => trans('admin::app.project.index.datagrid.description'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'custom_grid' => '4fr',
            'closure'    => function ($row) {
                return Str::limit($row->description,50);
            }
        ]);

        $this->addColumn([
            'index'      => 'leader_image',
            'label'      => trans('admin::app.project.index.datagrid.leader'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return $row->leader_image ? \Storage::url($row->leader_image) : '';
            }
//            'closure'    => function ($row) {
//                if ($row->leader_image) {
//                    $html = <<<HTML
//                    <div class="border-3 mr-2 inline-block h-9 w-9 overflow-hidden rounded-full border-gray-800 text-center align-middle">
//                        <img class="h-9 w-9" :src="$row->leader_image" alt="$row->leader_name" />
//                    </div>
//                HTML;
//                } else {
//                    $firstLetter = strtoupper($row->leader_name[0]);
//                    $html = <<<HTML
//                    <x-admin::multi-avatar v-bind:name="$firstLetter" v-bind:full_name="$row->leader_name" />
//                HTML;
//                }
//
//                return <<<HTML
//                        <div class="flex items-center gap-2.5">
//                           $html
//                        </div>
//                HTML;
//            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.project.index.datagrid.status'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
            $status = Project::STATUS[$row->status];
            $statusCssClass = $row->status == Project::ACTIVE ? 'label-active' : 'label-inactive';
                return <<<HTML
                        <span class="$statusCssClass"
                            >
                                $status
                            </span>
                    HTML;
            },
        ]);

        $this->addColumn([
            'index'      => 'member',
            'label'      => trans('admin::app.project.index.datagrid.member'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return User::whereHas('projects', function ($query) use ($row) {
                    return $query->where('projects.id', $row->id);
                })->get();
            },
        ]);


        $this->addColumn([
            'index'      => 'start_date',
            'label'      => trans('admin::app.project.index.datagrid.start_date'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return $row->start_date ? date('d/m/Y', strtotime($row->start_date)) : '';
            }
        ]);

        $this->addColumn([
            'index'      => 'end_date',
            'label'      => trans('admin::app.project.index.datagrid.end_date'),
            'type'       => 'string',
            'sortable'   => false,
            'filterable' => true,
            'closure'    => function ($row) {
                return $row->end_date ? date('d/m/Y', strtotime($row->end_date)) : '';
            }
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions(): void
    {
         if (bouncer()->hasPermission('project.create')) {
             $this->addAction([
                 'index'  => 'listPhase',
                 'icon'   => 'icon-list',
                 'title'  => trans('admin::app.project.view.phase'),
                 'method' => 'GET',
                 'url'    => fn ($row) => route('admin.phases.index', $row->id),
             ]);
             $this->addAction([
                 'index'  => 'edit',
                 'icon'   => 'icon-edit',
                 'title'  => trans('admin::app.project.edit.title'),
                 'method' => 'GET',
                 'url'    => fn ($row) => route('admin.projects.edit', $row->id),
             ]);

             $this->addAction([
                 'index'  => 'delete',
                 'icon'   => 'icon-delete',
                 'title'  => trans('admin::app.project.delete.title'),
                 'method' => 'DELETE',
                 'url'    => fn ($row) => route('admin.projects.delete', $row->id),
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
