<?php

namespace Webkul\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Project\Contracts\ProjectMember as ProjectMemberContract;

class ProjectMember extends Model implements ProjectMemberContract
{
    use SoftDeletes;

    protected $table = 'project_members';

    protected $fillable = [
        'id',
        'project_id',
        'user_id'
    ];
}