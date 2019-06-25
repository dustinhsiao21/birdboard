<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'body',
        'completed'
    ];

    public function path()
    {
        return route('project.task.update', ['project' => $this->project_id, 'task' => $this->id]);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
