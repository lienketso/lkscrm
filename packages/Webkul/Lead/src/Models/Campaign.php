<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    protected $table = 'campaigns';
    public $timestamps = true;

    public function schedules()
    {
        return $this->hasMany(CampaignSchedule::class, 'campaign_id');
    }
}
