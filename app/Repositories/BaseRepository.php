<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * model name.
     *
     * @var Model
     */
    private $model;

    /**
     * construct.
     *
     * @param Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * find model.
     *
     * @param ineteger $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->model->find($id);
    }

    /**
     * find model of fail.
     *
     * @param ineteger $id
     * @return Model
     */
    public function findOrFail($id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * find all models.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Undocumented function.
     *
     * @param array $array
     * @return Model
     */
    public function create(array $array): Model
    {
        return $this->model->create($array);
    }

    /**
     * find model and update.
     *
     * @param int $id model_id
     * @param array $array updated date
     * @return bool
     */
    public function update(int $id, array $array): bool
    {
        return $this->find($id)->update($array);
    }
}
