<?php

namespace App\Models;

use App\User;
use App\Models\Task;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'notes',
    ];

    public function path()
    {
        return route('project.show', ['id' => $this->id]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
