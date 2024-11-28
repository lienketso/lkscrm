<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'campaign_schedules';
    public $timestamps = true;

    public function scheduleContent()
    {
        return $this->hasMany(CampaignScheduleContent::class, 'campaign_schedule_id');
    }
}
