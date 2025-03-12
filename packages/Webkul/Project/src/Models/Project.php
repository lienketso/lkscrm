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
        'member_type
        ',
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
        self::ALL_MEMBER_TYPE => 'Tất cả thành viên',
        self::GROUP_MEMBER_TYPE => 'Theo thành viên của nhóm (leader group)'
    ];

    public function isAllMember(): bool
    {
        return $this->member_type == self::ALL_MEMBER_TYPE;
    }

    public function isGroupMember(): bool
    {
        return $this->member_type == self::ALL_MEMBER_TYPE;
    }

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

    public function hasProjectAccess($userId)
    {
        if ($this->isAllMember()) // member_type là tất cả nhân viên
        {
            return true;
        }
        $rs = $this->where(function ($subQ) use ($userId) {
            $subQ->whereHas('members', function ($sq) use ($userId) {
                $sq->where('user_id', $userId);
            })->orWhere('leader_id', $userId);
        });
        if ($rs) return true;
        return false;
    }
}