<?php

namespace Webkul\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webkul\Project\Contracts\Phase as PhaseContract;
use Webkul\Task\Models\TaskProxy;

class Phase extends Model implements PhaseContract
{
    use SoftDeletes;

    protected $table = 'phases';

    protected $fillable = [
        'id',
        'title',
        'description',
        'project_id',
        'start_date',
        'end_date',
        'status'
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS = [
        self::ACTIVE => 'Hoạt động',
        self::INACTIVE => 'Không hoạt động',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectProxy::modelClass(), 'id', 'project_id');
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TaskProxy::modelClass(), 'phase_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function (Phase $phase) {
            $tasks = $phase->tasks();
            $tasks->each(function ($item) {
                $item->subTasks()->delete(); // xoá sub task của task cha thuộc phase
            });
            $tasks->delete(); // xoá task cha
        });
    }
}