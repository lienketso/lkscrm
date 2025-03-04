<?php

namespace Webkul\TaskCategorySetting\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\TaskCategorySetting\Contracts\TaskCategorySetting as TaskCategorySettingContract;

class TaskCategorySetting extends Model implements TaskCategorySettingContract
{
    protected $table = 'task_category_settings';
    protected $fillable = [
        'title',
        'description',
        'css_class',
        'icon_class',
        'order',
    ];
}