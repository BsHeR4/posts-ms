<?php

namespace App\Services\Base;

use App\Exceptions\CrudException;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Services\Interfaces\BaseServiceInterface;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseService implements BaseServiceInterface
{

    protected BaseRepositoryInterface $repository;

    protected function handle(Closure $callback)
    {
        try {
            return $callback();
        } catch (ModelNotFoundException $e) {
            throw new CrudException("Resource Not Found", 404);
        } catch (\Throwable $e) {
            throw new CrudException('An unexpected error, ', 500);
        }
    }

    /**
     * Get paginated locations
     * 
     * @return LengthAwarePaginator The paginated list of  model
     */
    public function getAll(array $filters = [])
    {
        return $this->handle(function () use ($filters) {

            return $this->repository->getAll($filters);
        });
    }


    /**
     * to get one model using id
     * 
     * @param string get model by id
     */
    public function get(string $id)
    {
        return $this->handle(function () use ($id) {
            return $this->repository->get($id);
        });
    }

    /**
     * For store a new model
     * 
     * @param array $data To store the model
     */
    public function store(array $data)
    {
        return $this->handle(function () use ($data) {
            return $this->repository->store($data);
        });
    }

    /**
     * For update a model
     * 
     * @param array $data To Update the model
     * @param string|Model $id get model by id
     */
    public function update(array $data, string|Model $modelOrId)
    {
        return $this->handle(function () use ($data, $modelOrId) {

            return $this->repository->update($data, $modelOrId);
        });
    }

    /**
     *  Delete the specified model
     * 
     *  @param string $id get model by id
     *  @return bool|null True if the model was deleted, false otherwise
     */
    public function destroy(string $id)
    {
        return $this->handle(function () use ($id) {
            return $this->repository->destroy($id);
        });
    }
}
