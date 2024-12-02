<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'campaign_schedules';
    public $timestamps = true;

    const NOT_DONE = 1;
    const DONE = 2;
    const STATUS = [
        self::NOT_DONE => 'Chưa gửi',
        self::DONE => 'Gửi thành công',
    ];

    public function scheduleContent()
    {
        return $this->hasMany(CampaignScheduleContent::class, 'campaign_schedule_id');
    }
}
