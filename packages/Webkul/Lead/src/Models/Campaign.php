<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    protected $table = 'campaigns';
    public $timestamps = true;

    const ACTIVE = 1;
    const INACTIVE = 2;

    const STATUS = [
        self::ACTIVE => 'Hoạt động',
        self::INACTIVE => 'Không hoạt động',
    ];

    public function schedules()
    {
        return $this->hasMany(CampaignSchedule::class, 'campaign_id');
    }

    public function customers()
    {
        return $this->hasMany(CampaignCustomer::class, 'campaign_id');
    }
}
