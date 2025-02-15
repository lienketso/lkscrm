<?php

namespace Webkul\TaskPrioritySetting\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\TaskPrioritySetting\Contracts\TaskPrioritySetting as TaskPrioritySettingContract;

class TaskPrioritySetting extends Model implements TaskPrioritySettingContract
{
    protected $fillable = [];
}