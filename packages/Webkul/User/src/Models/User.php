<?php

namespace Webkul\User\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Webkul\Project\Models\PhaseProxy;
use Webkul\Project\Models\ProjectMemberProxy;
use Webkul\Project\Models\ProjectProxy;
use Webkul\Task\Models\TaskProxy;
use Webkul\User\Contracts\User as UserContract;

class User extends Authenticatable implements UserContract
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'api_token',
        'role_id',
        'leader_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'api_token',
        'remember_token',
    ];

    const ACTIVE = 1;

    const INACTIVE = 0;

    const STATUS = [
        self::ACTIVE   => 'Hoạt động',
        self::INACTIVE => 'Không hoạt động',
    ];

    /**
     * Get image url for the product image.
     */
    public function image_url()
    {
        if (! $this->image) {
            return;
        }

        return Storage::url($this->image);
    }

    /**
     * Get image url for the product image.
     */
    public function getImageUrlAttribute()
    {
        return $this->image_url();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['image_url'] = $this->image_url;

        return $array;
    }

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(RoleProxy::modelClass());
    }

    /**
     * The groups that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany(GroupProxy::modelClass(), 'user_groups');
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProjectProxy::modelClass(), 'project_members', 'user_id', 'project_id')->whereNull('project_members.deleted_at')->withTimestamps();
    }

    public function taskSupport(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TaskProxy::modelClass(), 'task_supports', 'user_id', 'task_id')->whereNull('task_supports.deleted_at')->withTimestamps();
    }

    /**
     * Checks if user has permission to perform certain action.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if ($this->role->permission_type == 'custom' && ! $this->role->permissions) {
            return false;
        }

        return in_array($permission, $this->role->permissions);
    }

    public function hasAllPermission()
    {
        if ($this->role && $this->role->permission_type == 'all') {
            return true;
        }

        return false;
    }

    public function leader(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserProxy::modelClass(), 'leader_id', 'id');
    }

    public function leaderProject(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany|User
    {
        return $this->hasMany(ProjectProxy::modelClass(), 'leader_id', 'id');
    }

    /*
     * Bảng quan hệ n-n với bảng project
     */
    public function memberProject(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectMemberProxy::modelClass(), 'user_id', 'id');
    }

    public function createdProject(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany|User
    {
        return $this->hasMany(ProjectProxy::modelClass(), 'created_by', 'id');
    }

    public function createdPhase(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany|User
    {
        return $this->hasMany(PhaseProxy::modelClass(), 'created_by', 'id');
    }

    public function createdTask(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany|User
    {
        return $this->hasMany(TaskProxy::modelClass(), 'created_by', 'id');
    }

    public function assigneeTask(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany|User
    {
        return $this->hasMany(TaskProxy::modelClass(), 'assignee_id', 'id');
    }

    /*
     * hàm check xem user có quyền vào xem dữ liệu với project (xem thông tin phase, task không - là leader dự án, người tạo, thành viên của dự án có quyền này)
     */
    public function canProjectAccess($projectId): bool
    {
        $leaderProject = $this->leaderProject()->where('id', $projectId)->exists(); // leader dự án
        $createdProject = $this->createdProject()->where('id', $projectId)->exists(); // tạo dự án
        $memberProject = $this->projects()->where('projects.id', $projectId)->exists(); // thành viên của dự án

        return $leaderProject || $createdProject || $memberProject || $this->hasAllPermission();
    }

    /*
     * hàm check xem user có quyền thao tác với project (thêm phase mới, xoá - edit project không - là leader dự án hoặc người tạo có quyền thao tác)
     */
    public function canAddAndDeleteProjectDataById($projectId): bool
    {
        $leaderProject = $this->leaderProject()->where('id', $projectId)->exists(); // leader dự án
        $createdProject = $this->createdProject()->where('id', $projectId)->exists(); // tạo dự án

        return $leaderProject || $createdProject || $this->hasAllPermission();
    }

    /*
     * hàm check xem user có quyền thao tác với phase (edit, xoá phase - là leader, người tạo dự án, người tạo phase có quyền thao tác)
     */
    public function canEditAndDeletePhaseById($projectId, $phaseId): bool
    {
        $leaderProject = $this->leaderProject()->where('id', $projectId)->exists(); // leader dự án
        $createdProject = $this->createdProject()->where('id', $projectId)->exists(); // tạo dự án
        $createdPhase = $this->createdPhase()->where('id', $phaseId)->exists(); // tạo phase

        return $leaderProject || $createdProject || $createdPhase || $this->hasAllPermission();
    }

    /*
     * hàm check xem user có quyền thao tác với task (edit, xoá task - là leader, người tạo dự án, người được giao hoặc người tạo task có quyền thao tác)
     */
    public function canEditAndDeleteTaskById($projectId, $taskId): bool
    {
        $leaderProject = $this->leaderProject()->where('id', $projectId)->exists(); // leader dự án
        $createdProject = $this->createdProject()->where('id', $projectId)->exists(); // tạo dự án
        $createdTask = $this->createdTask()->where('id', $taskId)->exists(); // tạo task
        $assigneeTask = $this->assigneeTask()->where('id', $taskId)->exists(); // được giao task
        $taskSupport = $this->taskSupport()->where('tasks.id', $taskId)->exists(); // hỗ trợ task
        return $leaderProject || $createdProject || $createdTask || $assigneeTask || $taskSupport || $this->hasAllPermission();
    }
}
