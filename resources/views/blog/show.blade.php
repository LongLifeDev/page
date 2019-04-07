@extends('layouts.app') 

@section('content')
    
    <div class="jumbotron text-center">
        <a href="/posts" class="btn btn-default"><< Back to Posts</a>
        <h1>{{$post->title}}</h1>
        <img style="width:25%" src="/storage/cover_images/{{$post->cover_image}}">
        <p>{!!$post->body!!}</p>
        <small>Posted on {{$post->created_at}}<br/> by {{$post->user->name}}</small>
    </div>
    @if(!Auth::guest()) 
        @if(!Auth::user()->id == $post->user_id) 
            <a href="/blogedit/{{$post->id}}" class="btn btn-default">Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection