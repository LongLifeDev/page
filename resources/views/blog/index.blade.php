@extends('layouts.app') 

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <div class="jumbotron text-white" style="background-image: url('/storage/site_images/LLBlogLogo.png');height:300px;background-size: 100% 100%;border: 8px double black; border-radius: 100px;">
                    
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                <section>
                <h1 class="text-center" style="text-shadow: 1px 1px black;"><span class="glyphicon glyphicon-leaf" style="font-size: 1em; color:green"></span>LongLifeBlog</h1>
                <p style="text-align:center;text-indent: 15px;"> Hey there! Thanks for stopping in. This blog is currently under development and up for testing. You can make an account and make a blog post.Try it, it's fun! Enjoy. </p><br/>
                </section>
            </div>   
        </div>
    </div>
        
        
    <article class="container">
    @if(count($posts) > 0)
        @foreach($posts as $post)
        <section class="well" style="margin: 0px 3% 0px 3%">
            <div class="row">
                <div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                </div>
                <div class="col-md-8 col-md-offset-0 col-sm-8 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                    <h2><a href="/posts/{{$post->id}}" style="text-decoration:none;color:#636b6f;text-shadow: 1px 1px black;"><b>{{$post->title}}</b></a></h2>
                    <h3><a href="/posts/{{$post->id}}" style="text-decoration:none;"><span style="color:#636b6f">{{$post->title_description}}</span><br/><small style="color:blue">read more...</small></a></h3>
                    <small>Written on {{$post->created_at}}<br/> by {{$post->user->name}}</small>
                </div>
            </div>  
        </section>
        @endforeach
        <div class="pull-right">{{$posts->links()}}</div>
    @else
        <p>No posts found.</p>
    @endif
    </article>
@endsection
