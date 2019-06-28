<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Activity;

class ActivityRepository extends BaseRepository
{
    public function __construct(Activity $model)
    {
        parent::__construct($model);
    }
}
