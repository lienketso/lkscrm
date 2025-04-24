<?php

namespace Webkul\TaskSupport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\TaskSupport\Contracts\TaskSupport as TaskSupportContract;

class TaskSupport extends Model implements TaskSupportContract
{
    use SoftDeletes;
    protected $table = 'task_supports';
    protected $fillable = [
        'user_id',
        'task_id',
    ];
}