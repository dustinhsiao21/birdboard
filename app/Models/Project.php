<?php

namespace App\Models;

use App\User;
use App\Models\Task;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'notes',
    ];

    /**
     * return relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * return relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * return relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * return relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    /**
     * get project path.
     *
     * @return string
     */
    public function path() : string
    {
        return route('project.show', ['id' => $this->id]);
    }

    /**
     * project could invite momber.
     *
     * @param User $user
     * @return void
     */
    public function invite(User $user)
    {
        $this->members()->attach($user);
    }
}
