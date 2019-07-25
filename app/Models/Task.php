<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'body',
        'completed',
    ];

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['project'];

    /**
     * return relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * return relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'task');
    }
}
