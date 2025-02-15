<?php

namespace Webkul\TaskStatusSetting\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\TaskStatusSetting\Contracts\TaskStatusSetting as TaskStatusSettingContract;

class TaskStatusSetting extends Model implements TaskStatusSettingContract
{
    protected $fillable = [];
    const DEFAULT_STATUS = 1;
}