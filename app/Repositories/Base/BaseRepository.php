<?php

namespace App\Repositories\Base;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface {

    protected Model $model;

    public function getAll(array $filters = [])
    {
        $query = $this->query($filters);
        $perPage = $filters['per_page'] ?? 10;
        return $query->paginate($perPage);
    }

    public function get(string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, string|Model $modelOrId)
    {
        if (!($modelOrId instanceof Model)) {
            $model = $this->model->findOrFail($modelOrId);
            $model->update($data);
            return $model;
        }

        $modelOrId->update($data);
        return $modelOrId;
    }

    public function destroy(string $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Prepare a base query for the model
     * Can be overridden in child repositories to apply custom filtering or eager loading
     * 
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder<Model>
     */
    public function query(array $filters = [])
    {
        return $this->model->newQuery(); ;
    }
}