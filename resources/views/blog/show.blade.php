@extends('layouts.app') 

@section('content')
    
    <div class="container">
        <article>
        <h1 class="text-center text-uppercase font-weight-bold">{{$post->title}}</h1>
        <div class="jumbotron text-white" style="background-image: url('/storage/cover_images/{{$post->cover_image}}');height:44rem;background-size: 100% 100%;">

        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <section class="text-center" style="margin: 2px 5% 2px">
                    <h2>{{$post->title_description}}</h2>
                    <small>Posted on {{$post->created_at}}<br/> by <b>{{$post->user->name}}</b></small>
                </section>   
            </div>
            <div class="col-md-12 col-sm-12">
                <section style="margin: 2px 7% 2px">
                    <span style="font-size:1.2em;text-indent: 2.5em;">{!!$post->body!!}</span>
                    <small>Posted on {{$post->created_at}}<br/> by <b>{{$post->user->name}}</b></small>
                </section>
             </div>
            </div>
    </article>  
    </div>
 
    <br/>
    <a href="/posts" class="btn btn-default pull-left"><< Back to Posts</a>  
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