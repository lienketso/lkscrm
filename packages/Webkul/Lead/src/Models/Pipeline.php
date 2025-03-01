<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Lead\Contracts\Pipeline as PipelineContract;

class Pipeline extends Model implements PipelineContract
{
    protected $table = 'lead_pipelines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'rotten_days',
        'is_default',
        'type',
    ];

    const CUSTOMER_TYPE = 1;
    const LEAD_TYPE = 2;

    const ARR_TYPE = [
        self::CUSTOMER_TYPE => 'Khách hàng hiện hữu',
        self::LEAD_TYPE => 'Khách hàng tiềm năng',
    ];

    /**
     * Get the leads.
     */
    public function leads()
    {
        return $this->hasMany(LeadProxy::modelClass(), 'lead_pipeline_id');
    }

    /**
     * Get the stages that owns the pipeline.
     */
    public function stages()
    {
        return $this->hasMany(StageProxy::modelClass(), 'lead_pipeline_id')->orderBy('sort_order', 'ASC');
    }
}
