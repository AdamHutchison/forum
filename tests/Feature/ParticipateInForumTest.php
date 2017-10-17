<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_authenticated_user_may_add_a_reply_to_forum_thread()
    {
        //create a user
        $user = factory('App\User')->create();

        //log the user in with be
        $this->be($user);

        //create the thread
        $thread = factory('App\Thread')->create();

        //create a reply
        $reply = factory('App\Reply')->make();

        //post the reply
        $this->post($thread->path() . '/replies', $reply->toArray());

        //assert that the reply can be seen on the thread page
        $this->get($thread->path())->assertSee($reply->body);
    }

    /**
     * @test
     */
    public function an_unauthenticated_user_may_not_add_replies()
    {
        $this->post('/threads/channel/1/replies', [])
            ->assertRedirect('/login');


    }

}