<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\User;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description'
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
}
