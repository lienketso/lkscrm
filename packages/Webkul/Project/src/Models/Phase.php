<?php

namespace Webkul\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Project\Contracts\Phase as PhaseContract;

class Phase extends Model implements PhaseContract
{
    use SoftDeletes;

    protected $table = 'phases';

    protected $fillable = [
        'id',
        'title',
        'description',
        'project_id',
        'start_date',
        'end_date',
        'status'
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS = [
        self::ACTIVE => 'Hoạt động',
        self::INACTIVE => 'Không hoạt động',
    ];

    public function project()
    {
        return $this->hasOne(ProjectProxy::modelClass(), 'id', 'project_id');
    }
}