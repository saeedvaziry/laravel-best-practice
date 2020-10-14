<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Post;
use App\Models\User;

interface PostRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param User $user
     * @param array $data
     * @return mixed
     */
    public function store(User $user, array $data);

    /**
     * @param Post $post
     * @param array $data
     * @return mixed
     */
    public function update(Post $post, array $data);

    /**
     * @param Post $post
     * @return mixed
     */
    public function destroy(Post $post);
}
