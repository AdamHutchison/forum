@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Thread</div>
                    <div class="panel-body">
                        <form action="/threads" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <lable for="channel">Choose a Channel</lable>
                                <select class="form-control" id="channel_id" name='channel_id' required>
                                    <option>Choose One.....</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{old('channel_id')== $channel->id ? 'selected':''}} >
                                            {{$channel->name}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <lable for="title">Title:</lable>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{old ('title')}}" required>
                            </div>


                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" id="body" class="form-control" rows="8" required>
                                    {{old('body')}}
                                </textarea>
                            </div>
                            <div class='form-group'>
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                            @if(count($errors))
                                <ul class='alert alert-danger'>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{$error}}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
