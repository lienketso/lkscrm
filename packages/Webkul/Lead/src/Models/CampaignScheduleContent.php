<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignScheduleContent extends Model
{
    use SoftDeletes;

    protected $table = 'campaign_schedule_content';
    public $timestamps = true;

    public function zaloTemplate()
    {
        return $this->belongsTo(ZaloTemplate::class, 'zalo_template_id', 'template_id');
    }

    public function zaloTemplateInfo()
    {
        return $this->belongsTo(ZaloTemplateInfo::class, 'zalo_template_info_id', 'id');
    }
}
