<?php

namespace Webkul\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Project\Contracts\Project as ProjectContract;
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
        'start_date',
        'end_date'
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS = [
        self::ACTIVE => 'Hoạt động',
        self::INACTIVE => 'Không hoạt động',
    ];

    public function leader(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserProxy::modelClass(), 'id', 'leader_id');
    }

    public function members(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(UserProxy::modelClass(), 'project_members', 'project_id', 'user_id')->whereNull('project_members.deleted_at')->withTimestamps();
    }

    public function projectMember(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectMemberProxy::modelClass(), 'user_id', 'id');
    }
}