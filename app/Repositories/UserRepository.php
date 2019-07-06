<?php

namespace App\Repositories;

use App\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findAllExcept(array $ids)
    {
        return $this->all()->whereNotIn('id', $ids);
    }
}
