<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignScheduleContent extends Model
{
    use SoftDeletes;

    protected $table = 'campaign_schedule_content';
    public $timestamps = true;
}
