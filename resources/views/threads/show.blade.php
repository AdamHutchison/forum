@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$thread->owner->name}} posted {{$thread->title}}</div>

                    <div class="panel-body">
                        <article>
                            <div class='body'>{{$thread->body}}</div>
                        </article>
                        <hr>
                    </div>
                </div>
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach

                @if(auth()->check())
                    <form action="{{$thread->path()}}/replies" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                    <textarea name="body" id="body" rows="5" class="form-control"
                              placeholder="Something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Reply</button>
                    </form>
                @else
                    <p class="text-center">Please <a href="/login">sign in</a> to participate in this discussion</p>
                @endif
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            This thread was created at {{$thread->created_at->diffForHumans()}}
                            by <a href="#">{{$thread->owner->name}}</a> and currently has
                            {{$thread->replies_count}} {{str_plural('comment',$thread->replies_count)}}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

