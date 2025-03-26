<?php

namespace Webkul\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Project\Models\PhaseProxy;
use Webkul\Project\Models\ProjectProxy;
use Webkul\Task\Contracts\Task as TaskContract;
use Webkul\TaskCategorySetting\Models\TaskCategorySettingProxy;
use Webkul\TaskPrioritySetting\Models\TaskPrioritySettingProxy;
use Webkul\TaskStatusSetting\Models\TaskStatusSettingProxy;
use Webkul\TaskSupport\Models\TaskSupport;
use Webkul\TaskSupport\Models\TaskSupportProxy;
use Webkul\User\Contracts\User;
use Webkul\User\Models\UserProxy;

class Task extends Model implements TaskContract
{
    use SoftDeletes;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'priority_id',
        'status_id',
        'category_id',
        'assignee_id',
        'project_id',
        'phase_id',
        'parent_id',
        'start_date',
        'end_date',
        'created_by'
    ];

    public function scopeParentTasks($query)
    {
        return $query->whereNull('parent_id');
    }

    public function isParentTask(): bool
    {
        return is_null($this->parent_id);
    }

    public function isSubTask(): bool
    {
        return !$this->isParentTask();
    }

    public function priority()
    {
        return $this->hasOne(TaskPrioritySettingProxy::modelClass(), 'id', 'priority_id');
    }

    public function status()
    {
        return $this->hasOne(TaskStatusSettingProxy::modelClass(), 'id', 'status_id');
    }

    public function category()
    {
        return $this->hasOne(TaskCategorySettingProxy::modelClass(), 'id', 'category_id');
    }

    public function assignee()
    {
        return $this->hasOne(UserProxy::modelClass(), 'id', 'assignee_id');
    }

    public function project()
    {
        return $this->hasOne(ProjectProxy::modelClass(), 'id', 'phase_id');
    }

    // Quan hệ với Leader thông qua Project
    public function leader()
    {
        return $this->hasOneThrough(UserProxy::modelClass(), ProjectProxy::modelClass(), 'id', 'id', 'project_id', 'leader_id');
    }

    public function phase()
    {
        return $this->belongsTo(PhaseProxy::modelClass(), 'project_id', 'id');
    }

    public function parentTask()
    {
        return $this->belongsTo(TaskProxy::modelClass(), 'parent_id', 'id');
    }

    public function subTasks()
    {
        return $this->hasMany(TaskProxy::modelClass(), 'parent_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(UserProxy::modelClass(), 'created_by', 'id');
    }

    public function userSupport(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(UserProxy::modelClass(), 'task_supports', 'task_id', 'user_id')->whereNull('task_supports.deleted_at')->withTimestamps();
    }

    public function relationUserSupport(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TaskSupportProxy::modelClass(), 'task_id', 'id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TaskCommentProxy::modelClass(), 'task_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function (Task $task) {
            $task->subTasks()->delete(); // xoá subtask của task cha
            $task->relationUserSupport()->delete(); // xoá bảng quan hệ các người hỗ trợ của dự án
        });
    }
}