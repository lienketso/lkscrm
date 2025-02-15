<?php

namespace Webkul\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Task\Contracts\Task as TaskContract;

class Task extends Model implements TaskContract
{
    use SoftDeletes;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'step',
        'description',
        'priority_id',
        'status_id',
        'assignee_id',
        'project_id',
        'phase_id',
        'parent_id',
        'start_date',
        'end_date'
    ];
}