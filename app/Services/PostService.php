<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Services\Base\BaseService;
use App\Services\Interfaces\PostServiceInterface;

class PostService extends BaseService implements PostServiceInterface
{
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
}
