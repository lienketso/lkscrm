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

    public function zaloTemplate()
    {
        return $this->belongsTo(ZaloTemplate::class, 'zalo_template_id', 'template_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function scheduleContent()
    {
        return $this->hasMany(CampaignScheduleContent::class, 'campaign_schedule_id');
    }

    public function scopeStartAt($query, $date)
    {
        return $query->where("start_at", 'LIKE', $date . '%');
    }

    public function scopeNotDone($query)
    {
        return $query->where("status", self::NOT_DONE);
    }

    public function scopeDone($query)
    {
        return $query->where("status", self::DONE);
    }
}
