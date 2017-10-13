<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function guest_may_not_create_threads()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = factory('App\Thread')->make();
        $this->post('/threads', $thread->toArray());
    }

    /**
     * @test
     */
    public function a_guest_cannot_see_create_threads_page()
    {
        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        //Given we have a signed in user
        $user = factory('App\User')->create();
        $this->be($user);

        //When we hit the endpoint to create a new thread
        $thread = factory('App\Thread')->make();
        $this->post('/threads', $thread->toArray());

        //Then when we visit the thread page, we should see the thread
        $this->get("/threads/$thread->id")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
