<?php

namespace Modules\Web\Adapters\Outbound\persistence\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository
{
    public function __construct(protected readonly Model $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->update($data);
        }
        return $model;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
