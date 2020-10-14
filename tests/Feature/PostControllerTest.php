<?php

namespace Tests\Feature;

use App\Jobs\PostCheckerJob;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPosts()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Post::factory()->count(5)->create([
            'user_id' => $user->id
        ]);

        $this->get(route('api.posts'))->assertStatus(200)->assertJson([
            'data' => [
                [
                    'user' => [
                        'name' => true,
                        'email' => true,
                    ],
                    'title' => true,
                    'content' => true
                ]
            ]
        ]);
    }

    /**
     * test success store a post
     */
    public function testStorePost()
    {
        $this->expectsJobs(PostCheckerJob::class);

        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->post(route('api.posts'), [
            'title' => $this->faker->text(100),
            'content' => $this->faker->text
        ])->assertStatus(201);
    }
}
