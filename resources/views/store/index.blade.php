@extends('layouts.app') 

@section('content')
    @if(count($products) > 0)
    
        <div class="jumbotron">
            <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
                    <div class="card" style="width:fill-parent">
                        <div class="card-body text-center">
                            <h1 class="card-title" style="font-size:2.8em;text-shadow: 1px 1px black;"><span class="glyphicon glyphicon-leaf" style="font-size:.85em;color:green"></span>LongLifeStore</h1>
                            <p class="card-text"> Under Development</p><br/>
                            <span style="">
                            <a href = "/getCart" class="card-link" style="text-decoration: none;border-style: double;border-radius: 10px;;padding:3%">
                                Shopping Cart : <span class="glyphicon glyphicon-shopping-cart" style="font-size: 1.4em"></span><span class="badge" style="padding-bottom: 5px"><b>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : ''}}</b></span>
                            </a>
                            </span>
                            
                        </div>  
                    </div>
                    <br/>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2 style="font-size:2.2em;text-align:center;text-shadow: 1px 1px black;"><span class="glyphicon glyphicon-leaf" style="font-size: .3em;color:green;-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH;-ms-filter: 'FlipH';"></span><span class="glyphicon glyphicon-leaf" style="font-size: .5em;color:green;-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH;-ms-filter: 'FlipH';"></span><span class="glyphicon glyphicon-leaf" style="font-size: .7em;color:green;-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH;-ms-filter: 'FlipH';"></span> Daily Deals <span class="glyphicon glyphicon-leaf" style="font-size: .7em;color:green; "></span><span class="glyphicon glyphicon-leaf" style="font-size: .5em;color:green; "></span><span class="glyphicon glyphicon-leaf" style="font-size: .3em;color:green; "></span></h2>
                    @if(count($daily) > 0)
                        <div class="container">
                            <div class="row justify-content-center">
                                @foreach($daily as $feature)
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                        <div class="card align-items-center">
                                            <div class="card-body text-center">
                                                <h3 class="card-title"><small>,<b>{{$feature->name}}</b></small></h3>
                                                <a href="/store/{{$feature->id}}" style="text-decoration:none;font-size:1em" ><img class="card-img-top" style="border: 1px solid #ddd;padding: 5px; border-radius: 6px;width:100%;height:130px;max-width:200px;max-height:200px" src="/storage/product_images/{{$feature->product_image_main}}"></a>
                                                <a href="/store/{{$feature->id}}" style="text-decoration:none;font-size:1em" >
                                                    <p class="card-text" style="font-size: 1em"><small>{{$feature->title}}</small></p>
                                                </a>
                                                <span><b>${{$feature->price}}</b></span>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a href="/addToCart/{{$feature->id}}" class="card-link"><b>Buy Now!</b></a>  
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div> 
            </div>
        </div>  
        </div>
        <h2 style="font-size:2.2em;text-align:center;text-shadow: 1px 1px black;"><span class="glyphicon glyphicon-leaf" style="font-size: .3em;color:green;-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH;-ms-filter: 'FlipH';"></span><span class="glyphicon glyphicon-leaf" style="font-size: .5em;color:green;-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH;-ms-filter: 'FlipH';"></span><span class="glyphicon glyphicon-leaf" style="font-size: .7em;color:green;-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH;-ms-filter: 'FlipH';"></span> Featured Products <span class="glyphicon glyphicon-leaf" style="font-size: .7em;color:green; "></span><span class="glyphicon glyphicon-leaf" style="font-size: .5em;color:green; "></span><span class="glyphicon glyphicon-leaf" style="font-size: .3em;color:green; "></span></h2>
        <div class="container">
            <div class="row justify-content-center">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                        <div class="card align-items-center">
                            <div class="card-body text-center">
                                <h3 class="card-title"><small>,<b>{{$product->name}}</b></small></h3>
                                <a href="/store/{{$product->id}}" style="text-decoration:none;font-size:1em" >
                                    <img class="card-img-top" style="border: 1px solid #ddd;padding: 5px; border-radius: 6px;width:100%;height:160px;max-width:200px;max-height:200px" src="/storage/product_images/{{$product->product_image_main}}">
                                </a>
                                <a href="/store/{{$product->id}}" style="text-decoration:none;font-size:1em" >
                                    <p class="card-text" style="font-size: 1em"><small>{{$product->title}}</small></p>
                                </a>
                                <span><b>${{$product->price}}</b></span>
                            </div>
                            <div class="card-footer text-center">
                                <a href="/addToCart/{{$product->id}}" class="card-link"><b>Buy Now!</b></a>  
                            </div>
                        </div>
                    </div>
        
        @endforeach
        {{$products->links()}}
    @else
        <p>No products found.</p>
    @endif
    
@endsection

