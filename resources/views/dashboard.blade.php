@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-uppercase font-weight-bold">
                    <b>{{ Auth::user()->name }}'s Dashboard</b>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <h3 style="text-align: center">User Control</h3>
                            <a href="/posts/create" class="btn btn-sm btn-primary center-block" style="width:108px;text-align:left "><span class="glyphicon glyphicon-pencil pull-left" style="font-size:1em;color:blue;"> </span> Create Post</a><br/> 
                        </div>
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <h3 style="text-align: center">Transactions</h3>
                            @if(count($transactions) > 0) 
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col"><span class="glyphicon glyphicon-leaf" style="font-size:1em;color:green"></span></th>
                                            <th scope="col">Date</th>
                                            <th scope="col">TransactionID</th>
                                            <th scope="col">Ammount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($transactions as $transaction)
                                        <tr>
                                            <th scope="row"><span class="glyphicon glyphicon-certificate" style="font-size:1em;"></span></th>
                                            <td>{{$transaction->created_at}}</td>
                                            <td>{{$transaction->trnsctn_id}}</td>
                                            <td>${{$transaction->ammount}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                            <h3 style="text-align: center">Blog Posts</h3>
                            @if(count($posts)>0)
                            <table class="table table-striped">
                                <tr>
                                    <th><span class="glyphicon glyphicon-wrench" style="font-size:1em;color:blue"></span></th>
                                    <th>Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <th><span class="glyphicon glyphicon-certificate" style="font-size:1em;"></span></th>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/blogedit/{{$post->id}}" class="btn btn-sm btn-primary">Edit</a></td>
                                        <td>
                                            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-sm btn-danger'])}}
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
    </div>
</div>
@endsection
