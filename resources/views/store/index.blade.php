@extends('layouts.app') 

@section('content')
    @if(count($products) > 0)
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12"> 
                    <h1 style="text-align: center"><span class="glyphicon glyphicon-leaf" style="font-size: 1em"></span>LongLifeStore</h1>
                    <p style="text-align: center">Under Development</p>
                    <br/>
                    <div style="text-align: center">
                        <a href = "/getCart" class="well" style="text-decoration: none;">
                            Shopping Cart : <span class="glyphicon glyphicon-shopping-cart" style="font-size: 1.4em"></span><span class="badge" style="padding-bottom: 5px"><b>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : ''}}</b></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <h2 style="text-align:center"><span class="glyphicon glyphicon-star" style="font-size: 1em"></span>Daily Deals<span class="glyphicon glyphicon-star" style="font-size: 1em"></span></h2>
                    @if(count($daily) > 0)
                    <div class="row">
                    @foreach($daily as $feature)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="card" style="height:14rem;padding-top:2%">
                        <a href="/store/{{$feature->id}}" >
                            <img class="card-img-top img-responsive" style="max-width: auto;max-height: 100%;" src="/storage/product_images/{{$feature->product_image_main}}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{$feature->name}}</h5>
                            <p class="card-text">{{$feature->title}}</p>
                            <span><b>${{$feature->price}}</b></span>
                            <a href="/addToCart/{{$feature->id}}" class="btn btn-success pull-right"><b>Buy Now!</b></a>  
                        </div>
                    </div>
                    </div>
                    @endforeach
                    </div>
                    @endif
                    
                </div> 
            </div>  
        </div>
        <h2><span class="glyphicon glyphicon-heart" style="font-size: 1em"></span>Featured Products</h2>
        @foreach($products as $product)
        <div class="well">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-3"> 
                    <img class="img-responsive" style="max-width: auto;max-height: 100%" src="/storage/product_images/{{$product->product_image_main}}">
                </div>
                <div class="col-md-10 col-sm-10 col-xs-9">
                    <h3><a href="/store/{{$product->id}}">{{$product->name}}</a></h3>
                    <a href="/store/{{$product->id}}">{{$product->title}}</a>
                    <small><b>Price: ${{$product->price}}</b></small><br/>
                    <a href="/addToCart/{{$product->id}}" class="btn btn-success"><b>Add to Cart</b></a> 
                </div> 
            </div>  
        </div>
        @endforeach
        {{$products->links()}}
    @else
        <p>No products found.</p>
    @endif

@endsection