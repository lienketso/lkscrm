<?php

namespace Webkul\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Task\Contracts\TaskComment as TaskCommentContract;
use Webkul\User\Models\UserProxy;

class TaskComment extends Model implements TaskCommentContract
{
    use SoftDeletes;
    protected $table = 'task_comments';
    protected $fillable = [
        'user_id',
        'task_id',
        'content'
    ];

    public function task(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TaskProxy::modelClass(), 'task_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserProxy::modelClass(), 'user_id');
    }

}