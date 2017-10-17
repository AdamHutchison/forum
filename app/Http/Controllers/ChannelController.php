<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Thread;

class ChannelController extends Controller
{
    public function index($channel)
    {
        $channelId = Channel::where('slug',$channel)->first()->id;
        $threads = Thread::where('channel_id', $channelId)->latest()->get();
        return view('threads.channelIndex', compact('threads'));

    }
}
