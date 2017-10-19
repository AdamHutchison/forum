<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    protected $thread;

    /**
     * setup tests by creating a thread
     */
    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /**
     * @test
     */
    public function a_user_can_view_multiple_threads()
    {
        //send get request to /threads
        $response = $this->get('/threads');
        //assert that the thread title can be seen
        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_see_a_single_thread()
    {
        //send get request to /threads/{threadID}
        $response = $this->get($this->thread->path());
        //assert that the thread title can be seen
        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_see_the_replies_to_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $response = $this->get($this->thread->path());
        $response->assertSee($reply->body);
    }

    /**
     * @test
     */
    public function the_thread_author_is_displayed()
    {
        $response = $this->get($this->thread->path());
        $response->assertSee($this->thread->owner->name);
    }

    /**
     * @test
     */
    public function a_user_can_filter_threads_according_to_a_tag()
    {
        $this->withoutExceptionHandling();
        $channel = factory('App\Channel')->create();
        $threadInChannel = factory('App\Thread')->create(['channel_id' => $channel->id]);
        $threadNotInChannel = factory('App\Thread')->create();

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
    /**
     *@test
     */
     public function a_user_can_filter_threads_by_any_username()
     {
        $user = factory('App\User')->create(['name'=>'John Doe']);
        $this->be($user);
        $threadByJohn = factory('App\Thread')->create(['user_id'=>$user->id]);
        $threadNotByJohn = factory('App\Thread')->create();

        $this->get('threads/user/John%20Doe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);


     }
}
