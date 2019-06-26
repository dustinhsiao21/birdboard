<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'body',
        'completed',
    ];

    protected $touches = ['project'];

    public function path()
    {
        return route('project.task.update', ['project' => $this->project_id, 'task' => $this->id]);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
