<?php

namespace Webkul\Admin\Http\Controllers\Lead;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Lead\CampaignDataGrid;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        // do some thing
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(CampaignDataGrid::class)->process();
        }

        return view('admin::campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $lead = $this->leadRepository->findOrFail($id);

        return view('admin::leads.edit', compact('lead'));
    }

    /**
     * Display a resource.
     */
    public function view(int $id)
    {
        $lead = $this->leadRepository->findOrFail($id);
        $userIds = bouncer()->getAuthorizedUserIds();
        if ($userIds && !in_array($lead->user_id, $userIds)) {
            return redirect()->route('admin.leads.index');
        }

        return view('admin::leads.view', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        
    }
}
