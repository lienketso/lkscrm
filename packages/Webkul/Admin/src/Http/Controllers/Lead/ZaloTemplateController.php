<?php

namespace Webkul\Admin\Http\Controllers\Lead;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Lead\ZaloTemplateDataGrid;
use Webkul\Lead\Models\ZaloTemplate;
use Webkul\Lead\Models\ZaloTemplateInfo;

class ZaloTemplateController extends Controller
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
            return datagrid(ZaloTemplateDataGrid::class)->process();
        }

        return view('admin::zalo.template');
    }

    public function syncZaloMessageTemplate()
    {
        // Event::dispatch('zalo.template.before');

        Event::dispatch('zalo.template.after');

        session()->flash('success', trans('admin::app.zalo.sync_template_from_zalo_mes'));

        return redirect()->route('admin.zalo.template.index');
    }

    /**
     * Display a resource.
     */
    public function view(int $id)
    {
        $template = ZaloTemplate::findOrFail($id);
        // dd($template->id);

        return view('admin::zalo.view-template', compact('template'));
    }
}
