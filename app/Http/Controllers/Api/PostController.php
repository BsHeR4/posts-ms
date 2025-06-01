<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterPostsRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\Interfaces\PostServiceInterface;

class PostController extends Controller
{

    /**
     * Service to handle post-related logic 
     * and separating it from the controller
     * 
     * @var PostServiceInterface
     */
    protected $postService;

    /**
     * PostController constructor
     *
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        // Inject the PostService to handle post-related logic
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FilterPostsRequest $request)
    {
        $filters = $request->validated();
        $posts = $this->postService->getAll($filters);
        return $this->successResponse(
            'success',
            PostResource::collection($posts)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = $this->postService->store($data);
        return $this->successResponse('success', new PostResource($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->get($id);
        return $this->successResponse('success', new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $data = $request->validated();
        $post = $this->postService->update($data, $id);

        return $this->successResponse('success', new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->postService->destroy($id);
        return $this->successResponse('success');
    }
}
