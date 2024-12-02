<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignCustomer extends Model
{
    use SoftDeletes;

    protected $table = 'campaign_customers';
    public $timestamps = true;

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
