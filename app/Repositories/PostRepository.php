<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
 {
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function query(array $filters = [])
    {
        $query = parent::query();

        $query->when(isset($filters['title']), function ($query) use ($filters) {
            return $query->title($filters['title']);
        });

        $query->when(isset($filters['tags']), function ($query) use ($filters) {
            return $query->tags($filters['tags']);
        });

        return $query;
    }
 }