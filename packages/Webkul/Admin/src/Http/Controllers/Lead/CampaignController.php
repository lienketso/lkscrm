<?php

namespace Webkul\Admin\Http\Controllers\Lead;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Lead\CampaignDataGrid;
use Illuminate\Http\Request;
use Webkul\Admin\Http\Requests\CampaignForm;
use Webkul\Lead\Models\Campaign;
use Webkul\Lead\Models\CampaignSchedule;
use Webkul\Lead\Models\CampaignScheduleContent;
use Webkul\Lead\Models\CampaignCustomer;
use Webkul\Lead\Models\ZaloTemplate;
use Illuminate\Support\Facades\DB;

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
        $znsTemplates = ZaloTemplate::select('template_id', 'template_name')->with(['info:template_id,id,name,require,type,max_length'])->get();
        return view('admin::campaign.create', compact('znsTemplates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampaignForm $request)
    {
        $params = (Object) $request->all();
        // dd($params);

        DB::beginTransaction();

        try {
        
            $campaign = new Campaign();
            $campaign->name = $params->name;
            $campaign->description = $params->description;
            $campaign->save();

            # customers
            foreach ($params->customers as $customerId) {
                $campaignCustomer = new CampaignCustomer();
                $campaignCustomer->campaign_id = $campaign->id;
                $campaignCustomer->lead_id = $customerId;
                $campaignCustomer->save();
            }

            # schedules
            foreach ($params->schedules as $schedule) {
                $schedule = (Object) $schedule;
                $campaignSchedule = new CampaignSchedule();
                $campaignSchedule->campaign_id = $campaign->id;
                $campaignSchedule->start_at = $schedule->date_time;
                $campaignSchedule->zalo_template_id = $schedule->template_id;
                $campaignSchedule->save();

                # CampaignScheduleContent
                foreach ($schedule->params as $key => $valParam) {
                    
                    $tmpIds = explode('_', $key);
                    $zaloTemplateInfoId = $tmpIds[count($tmpIds) - 1];

                    $campaignScheduleContent = new CampaignScheduleContent();
                    $campaignScheduleContent->campaign_id = $campaign->id;
                    $campaignScheduleContent->campaign_schedule_id = $campaignSchedule->id;
                    $campaignScheduleContent->zalo_template_id = $schedule->template_id;
                    $campaignScheduleContent->zalo_template_info_id = $zaloTemplateInfoId;
                    $campaignScheduleContent->content = $valParam;
                    $campaignScheduleContent->save();
                }
            }

            DB::commit();

            session()->flash('success', trans('admin::app.campaign.create-success'));

            return redirect()->route('admin.campaign.index');
        } catch (\Exception $exception) {
            // dd($exception);
            DB::rollback();
           
            session()->flash('error', trans('admin::app.campaign.create-failed'));

            return redirect()->route('admin.campaign.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $campaign = Campaign::findOrFail($id);

        $customers = [];
        foreach($campaign->customers as $item) {
            $customers[] = $item->lead;
        }
        
        return view('admin::campaign.edit', compact('campaign', 'customers'));
    }

    /**
     * Display a resource.
     */
    public function view(int $id)
    {
        $lead = Campaign::findOrFail($id);

        return view('admin::campaign.view', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CampaignForm $request, int $id)
    {
        
    }
}
