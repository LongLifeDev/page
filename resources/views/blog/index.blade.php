@extends('layouts.app') 

@section('content')
    <h1><span class="glyphicon glyphicon-leaf" style="font-size: 1em"></span>LongLifeBlog</h1>
    <p>Under Development</p>
    @if(count($posts) > 0)
        @foreach($posts as $post)
        <div class="well">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                </div>
                <div class="col-md-10 col-sm-10 col-xs-9">
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at}}<br/> by {{$post->user->name}}</small>
                </div>
            </div>  
        </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found.</p>
    @endif

@endsection