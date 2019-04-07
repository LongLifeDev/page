@extends('layouts.app') 

@section('content')
    <h1>LongLifeMicro Inventory</h1>
    <p>Under Development</p>
    @if(count($products) > 0)
        @foreach($products as $product)
        <div class="well">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-3"> 
                    <img style="width:100%" src="/storage/product_images/{{$product->product_image_main}}">
                </div>
                <div class="col-md-10 col-sm-10 col-xs-9">
                    <h3><a href="/inventory/{{$product->id}}">{{$product->name}}</a></h3>
                    <a href="/inventory/{{$product->id}}">{{$product->title}}</a>
                    <small>Price: ${{$product->price}}</small>
                    <a href="/inventory/{{$product->id}}/edit" class="btn btn-primary pull-right">Edit</a>
                </div> 
            </div>  
        </div>
        @endforeach
        {{$products->links()}}
    @else
        <p>No products found.</p>
    @endif

@endsection