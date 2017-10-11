<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_authenticated_user_may_participate_in_forum_thread()
    {
        //create a user
        $user = factory('App\User')->create();

        //log the user in with be
        $this->be($user);

        //create the thread
        $thread = factory('App\Thread')->create();

        //create a reply
        $reply = factory('App\Reply')->create();

        //post the reply
        $this->post('/threads/'.$thread->id.'/replies', $reply->toArray());

        //assert that the reply can be seen on the thread page
        $this->get('/threads/'.$thread->id)->assertSee($reply->body);

    }
}
