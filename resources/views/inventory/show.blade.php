@extends('layouts.app') 

@section('content')
    
    <div class="jumbotron text-center">
        <a href="/inventory" class="btn btn-default"><< Back to Inventory</a>
        <h1>{{$product->name}}</h1>
        <h2>{{$product->title}}</h2>
        <img style="width:25%" src="/storage/product_images/{{$product->product_image_main}}">
        <img style="width:25%" src="/storage/product_images/{{$product->product_image_secondary}}">
        <p>${!!$product->price!!}</p>
        <p>{!!$product->description!!}</p>
        <small>Posted on {{$product->created_at}}<br/> by {{$product->user->name}}</small><br/>
        @if(!Auth::guest()) 
            @if(Auth::user()->id == $product->user_id) 
                <a href="/inventory/{{$product->id}}/edit" class="btn btn-default pull-left">Edit</a>
                {!!Form::open(['action' => ['InventoryController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            @endif
        @endif
    </div>
    
@endsection