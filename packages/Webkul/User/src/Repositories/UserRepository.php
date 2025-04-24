<?php

namespace Webkul\User\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Project\Models\Project;
use Webkul\User\Models\User;

class UserRepository extends Repository
{
    /**
     * Searchable fields
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'status',
        'view_permission',
        'role_id',
    ];

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\User\Contracts\User';
    }

    /**
     * This function will return user ids of current user's groups
     *
     * @return array
     */
    public function getCurrentUserGroupsUserIds()
    {
        $userIds = $this->scopeQuery(function ($query) {
            return $query->select('users.*')
                ->leftJoin('user_groups', 'users.id', '=', 'user_groups.user_id')
                ->leftJoin('groups', 'user_groups.group_id', 'groups.id')
                ->whereIn('groups.id', auth()->guard('user')->user()->groups()->pluck('id'));
        })->get()->pluck('id')->toArray();

        return $userIds;
    }

    public function getLeaderListSelectInput($excludeId)
    {
        $query = $this->getModel()->where('status', User::ACTIVE)->when($excludeId, function ($sQuery, $excludeId) {
            return $sQuery->whereNot('id', $excludeId);
        });

        return $query->get(['id', 'name', 'email'])->toArray();
    }

    public function getMemberByLeader($groupId, $memberType = Project::GROUP_MEMBER_TYPE, $excludeId = null)
    {
        if ((!$groupId && $memberType == Project::GROUP_MEMBER_TYPE) || (!$groupId && !$memberType)) {
            return [];
        }

        return $this->getModel()->when($groupId, function ($sQ) use ($groupId) {
            $sQ->whereHas('groups', function ($subQ) use ($groupId) {
                return $subQ->where('id', $groupId);
            });
        })->when($excludeId, function ($sQuery, $excludeId) {
            return $sQuery->whereNot('id', $excludeId);
        })->where('status', User::ACTIVE)->get(['id', 'name', 'email'])->toArray();
    }

    public function getUserSupport($projectId, $excludeId = null)
    {
        $member = $this->getModel()->whereHas('projects', function ($subQ) use ($projectId) {
            return $subQ->where('projects.id', $projectId);
        })->get(['id', 'name', 'email'])->toArray();

        $leader = $this->getModel()->whereHas('leaderProject', function ($subQ) use ($projectId) {
            return $subQ->where('id', $projectId);
        })->get(['id', 'name', 'email'])->toArray();
        return array_merge($member, $leader);
    }

    public function getAssignOnlyMe()
    {
        return [
            [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]
        ];
    }

    public function getAssignByProject($projectId, $excludeId = null)
    {
        $member = $this->getModel()->whereHas('projects', function ($subQ) use ($projectId, $excludeId) {
            return $subQ->where('projects.id', $projectId);
        })->when($excludeId, function ($sQuery, $excludeId) {
            return $sQuery->whereNot('id', $excludeId);
        })->where('status', User::ACTIVE)->get(['id', 'name', 'email'])->toArray();

        $leader = $this->getModel()->whereHas('leaderProject', function ($subQ) use ($projectId, $excludeId) {
            return $subQ->where('id', $projectId);
        })->when($excludeId, function ($sQuery, $excludeId) {
            return $sQuery->whereNot('id', $excludeId);
        })->where('status', User::ACTIVE)->get(['id', 'name', 'email'])->toArray();
        return array_merge($member, $leader);
    }
}
