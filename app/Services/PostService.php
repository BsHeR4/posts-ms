<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Services\Base\BaseService;
use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostService extends BaseService implements PostServiceInterface
{
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = [])
    {
        return $this->handle(
            function () use ($filters) {

                $key = empty($filters) ? 'posts' : 'posts.' . md5(json_encode($filters));

                $time = empty($filters) ? 3600 : 180;

                return Cache::remember(
                    $key,
                    $time,
                    function () use ($filters) {
                        return parent::getAll($filters);
                    }
                );
            }
        );
    }

    public function store(array $data)
    {
        return $this->handle(function () use ($data) {

            $post = parent::store($data);
            
            Cache::forget('posts');

            return $post;
        });
    }

    public function update(array $data, string|Model $id)
    {
        return $this->handle(function () use ($data, $id) {
            $post = parent::update($data, $id);

            Cache::forget('posts');

            return $post;
        });
    }
}
