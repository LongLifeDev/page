@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center text-uppercase font-weight-bold">
                        <b>Dashboard Control</b>
                    </div>
                    <div class="panel-body">
                        <h3 style="text-align:center;text-shadow: 1px 1px black;">Daily Deals</h3>
                        @if(count($daily) > 0)
                            <div class="row">
                                @foreach($daily as $feature)
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h3 class="card-title"><small>{{$feature->name}}</small></h3>
                                                <img class="card-img-top" style="border: 1px solid #ddd; border-radius: 6px;width:85px;height:85px;max-width:200px;max-height:200px" src="/storage/product_images/{{$feature->product_image_main}}">
                                                <a href="/store/{{$feature->id}}" style="text-decoration:none;font-size:1em" >
                                                    <p class="card-text" style="font-size: 1em"><small>{{$feature->title}}</small></p>
                                                </a>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a href="/inventory/{{$feature->id}}/edit" class="card-link"><b>Edit</b></a>  
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>     
                        @endif
                        
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <h3 style="text-align: center;text-shadow: 1px 1px black; ">Management Panel</h3><br/>
                                <div class="col-md-6 col-sm-12 col-xs-6">
                                    <a href="/posts/create" class="btn btn-sm btn-primary center-block" style="width:105px;text-align:center;margin-bottom:10px "><span class="glyphicon glyphicon-pencil pull-left" style="font-size:1em;color:blue;"> </span> Create Post</a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-6">
                                    <a href="/inventory/create" class="btn btn-sm btn-primary center-block" style="width:105px;text-align:;margin-bottom:10px"><span class="glyphicon glyphicon-plus pull-left" style="font-size:1em;color:blue;"> </span> Add Product</a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-6">
                                    <a href="/inventory" class="btn btn-sm btn-primary center-block" style="width:105px;text-align:center;margin-bottom:10px"><span class="glyphicon glyphicon-tags pull-left" style="font-size:1em;color:blue;"> </span> Inventory</a>
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-6">
                                    <a href="/transactions" class="btn btn-sm btn-primary center-block" style="width:105px;text-align:center;margin-bottom:10px"><span class="glyphicon glyphicon-usd pull-left" style="font-size:1em;color:blue;"> </span> Transactions</a>
                                </div> 
                                <br/><br/><br/><br/>
                                <h3 style="text-align: center;text-shadow: 1px 1px black;">Users</h3>
                                @if(count($users) > 0) 
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col"><span class="glyphicon glyphicon-user" style="font-size:1em;color:blue"></span></th>
                                                <th scope="col">User name</th>
                                                <th scope="col">ID</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($users as $user)
                                            <tr>
                                                <th scope="row"><span class="glyphicon glyphicon-certificate" style="font-size:1em;"></span></th>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->id}}</td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody> 
                                    </table>
                                </div>
                                    <span class="" style="font-size: 9px;">{{$users->links()}}</span>   
                                    <br/> 
                                @endif  
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <h3 style="text-align: center;text-shadow: 1px 1px black;">Transactions</h3>
                                @if(count($transactions) > 0) 
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col"><span class="glyphicon glyphicon-leaf" style="font-size:1em;color:green"></span></th>
                                                <th scope="col">Date</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Ammount</th>
                                                <th scope="col">Transaction#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($transactions as $transaction)
                                            <tr>
                                                <th scope="row"><span class="glyphicon glyphicon-certificate" style="font-size:1em;"></span></th>
                                                <td>{{$transaction->created_at}}</td>
                                                <td>{{$transaction->user_id}}</td>
                                                <td>${{$transaction->ammount}}</td>
                                                <td>{{$transaction->trnsctn_id}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody> 
                                    </table>
                                </div>
                                    <span class="" style="font-size: 9px;">{{$transactions->links()}}</span>   
                                    <br/> 
                                @endif
                                <h3 style="text-align: center;text-shadow: 1px 1px black;">Blog Posts</h3>
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