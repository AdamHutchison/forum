<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

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
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_see_a_single_thread()
    {
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_see_the_replies_to_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($reply->body);
    }

    /**
     * @test
     */
    public function the_thread_author_is_displayed()
    {
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->thread->owner->name);
    }
}
