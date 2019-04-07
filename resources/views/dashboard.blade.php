@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-5 col-xs-5">
                            <h3>Admin Control</h3>
                            <a href="/posts/create" class="btn btn-primary">Create Post</a><br/>
                            <a href="/inventory/create" class="btn btn-primary">Add Product</a><br/>
                            <a href="/inventory" class="btn btn-primary">Manage Inventory</a>
                        </div>
                        <div class="col-md-8 col-sm-7 col-xs-7">
                            <h3 style="text-align: center">Daily Deals</h3>
                    @if(count($daily) > 0) 
                    <div class="row>">
                    @foreach($daily as $feature)
                    <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="card" style="">
                        <a href="/store/{{$feature->id}}">
                            <img class="card-img-top img-responsive" style="max-width: auto;max-height: 100%" src="/storage/product_images/{{$feature->product_image_main}}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{$feature->name}}</h5>
                            <a href="/inventory/{{$feature->id}}/edit" class="btn btn-link"><b>Edit</b></a>  
                        </div>
                    </div>
                    </div>
                    @endforeach
                    
                    @endif
                    </div>
                    </div>
                    </div>
                    <h3>Your Blog Posts</h3>
                    @if(count($posts)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <th>{{$post->title}}</th>
                                <td><a href="/blogedit/{{$post->id}}" class="btn btn-default">Edit</a></td>
                                <td>
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
