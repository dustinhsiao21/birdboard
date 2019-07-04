<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Activity extends Model
{
    protected $guarded = [];

    public function task()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
