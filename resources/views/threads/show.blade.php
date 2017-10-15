@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$thread->owner->name}} posted {{$thread->title}}</div>

                    <div class="panel-body">
                        <article>
                            <div class='body'>{{$thread->body}}</div>
                        </article>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>
        @if(auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="/threads/{{$thread->id}}/replies" method = "POST">
                        {{csrf_field()}}
                        <div class = "form-group">
                            <textarea name = "body" id = "body" rows="5" class = "form-control" placeholder="Something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Reply</button>
                    </form>
                </div>
            </div>
        @else
            <p class = "text-center">Please <a href = "/login">sign in</a> to participate in this discussion</p>
        @endif
    </div>
@endsection

