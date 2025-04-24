<?php

namespace Webkul\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Project\Contracts\Project as ProjectContract;
use Webkul\User\Models\GroupProxy;
use Webkul\User\Models\UserProxy;

class Project extends Model implements ProjectContract
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'id',
        'title',
        'description',
        'leader_id',
        'status',
        'member_type',
        'group_id',
        'start_date',
        'end_date'
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS = [
        self::ACTIVE => 'Hoạt động',
        self::INACTIVE => 'Không hoạt động',
    ];

    /*
     * Định nghĩa type (tất cả member đều được join hoặc theo các thành viên thuộc team đó)
     */
    const ALL_MEMBER_TYPE = 1;
    const GROUP_MEMBER_TYPE = 2;
    const TYPE = [
        self::ALL_MEMBER_TYPE => 'Tất cả các nhóm',
        self::GROUP_MEMBER_TYPE => 'Thành viên theo từng nhóm'
    ];

    public function leader(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserProxy::modelClass(), 'id', 'leader_id');
    }

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GroupProxy::modelClass(), 'id', 'group_id');
    }

    public function members(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(UserProxy::modelClass(), 'project_members', 'project_id', 'user_id')->whereNull('project_members.deleted_at')->withTimestamps();
    }

    public function projectMember(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectMemberProxy::modelClass(), 'project_id', 'id');
    }

    public function phases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PhaseProxy::modelClass(), 'project_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function (Project $project) { // before delete() method call this
            $phases = $project->phases();
            $phases->each(function ($item) {
                $item->tasks()->delete(); // xoá task của phase thuộc project
            });
            $project->projectMember()->delete(); // xoá bảng quan hệ
            $phases->delete(); // xoá các phase thuộc project
        });
    }
}