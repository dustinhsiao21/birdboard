<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * find all users except some user.
     *
     * @param  array  $ids
     * @return collection
     */
    public function findAllExcept(array $ids): Collection
    {
        return $this->all()->whereNotIn('id', $ids);
    }
}
