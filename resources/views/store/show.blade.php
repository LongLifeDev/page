@extends('layouts.app') 

@section('content')
    <a href="/store" class="btn btn-info pull-left"><span class="
        glyphicon glyphicon-hand-left" style="font-size: 1em"></span> Back</a>
    <a href = "/getCart" class="well pull-right" style="text-decoration: none;">
        Shopping Cart : <span class="glyphicon glyphicon-shopping-cart" style="font-size: 1.4em"></span><span class="badge" style="padding-bottom: 5px"><b>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : ''}}</b></span>
   </a>
    <div class="jumbotron text-center">
            <h1><b>{{$product->title}}</b></h1>
        <div class="row">
                
            <div class="col-md-3 col-sm-4 col-xs-12"> 
                <h2><b>{{$product->name}}</b></h2>
                <span style="color:blue"><b>${!!$product->price!!}</b></span>
                <a href="/addToCart/{{$product->id}}" class="btn btn-success"><b>Add to Cart</b></a>        
            </div>
            <div class="col-md-9 col-sm-8 col-xs-12">
                <img class="pull-left img-responsive" style="max-width: 50%;max-height: 50%" src="/storage/product_images/{{$product->product_image_main}}">
                <img class="img-responive" style="max-width: 50%;max-height: 50%" src="/storage/product_images/{{$product->product_image_secondary}}">          
            </div> 
        </div> 
        <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12"> 
                    <h3><b>Description</b></h3>
                    <p>{!!$product->description!!}</p>     
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12"> 
                    <br/><h4><b>Specifications</b></h4> 
                    <p>{!!$product->product_info!!}</p>       
                </div> 
            </div> 
    </div>
          
@endsection