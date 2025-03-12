<?php

namespace Webkul\User\Repositories;

use Webkul\Core\Eloquent\Repository;
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

    public function getMemberByLeader($groupArr, $excludeId = null)
    {
        if (!$groupArr) {
            return [];
        }

        return $this->getModel()->whereHas('groups', function ($subQ) use ($groupArr) {
            return $subQ->whereIn('id', $groupArr);
        })->when($excludeId, function ($sQuery, $excludeId) {
            return $sQuery->whereNot('id', $excludeId);
        })->where('status', User::ACTIVE)->get(['id', 'name', 'email'])->toArray();
    }
}
