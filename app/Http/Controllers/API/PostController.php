<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PostRepository;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * PostController constructor.
     * @param $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the post.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $posts = $this->repository->all();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return PostResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PostStoreRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = $this->repository->store($request->user(), $request->validated());

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return PostResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $post = $this->repository->find($id);

        $this->authorize('view', $post);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = $this->repository->find($id);

        $this->authorize('update', $post);

        $this->repository->update($post, $request->validated());

        return response()->json([
            'message' => 'Post updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = $this->repository->find($id);

        $this->authorize('update', $post);

        $this->repository->destroy($post);

        return response()->json([
            'message' => 'Post deleted'
        ]);
    }
}
