<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('App\Models\User');
    }
}
