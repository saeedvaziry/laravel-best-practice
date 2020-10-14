<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\User;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @return Post[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return Post::all();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function find($id)
    {
        return Post::query()->findOrFail($id);
    }

    /**
     * @param User $user
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function store(User $user, array $data)
    {
        return $user->posts()->create($data);
    }

    /**
     * @param Post $post
     * @param array $data
     * @return bool
     */
    public function update(Post $post, array $data)
    {
        return $post->update($data);
    }

    /**
     * @param Post $post
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}
