<?php

namespace Webkul\User\Repositories;

use Webkul\Core\Eloquent\Repository;

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

    public function getLeaderListSelectInput()
    {
        return $this->getModel()->whereNull('leader_id')->get(['id', 'name', 'email'])->toArray();
    }

    public function getMemberByLeader($leaderId)
    {
        $query = $this->getModel()->when($leaderId, function ($sq) use ($leaderId) {
            $sq->where('leader_id', $leaderId);
        });
        return $query->get(['id', 'name', 'email'])->toArray();
    }
}
