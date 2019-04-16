@extends('layouts.app') 

@section('content')
    <h1 class="text-center"><span class="glyphicon glyphicon-leaf" style="font-size: 1em;"></span>LongLifeStore Cart<span class="glyphicon glyphicon-shopping-cart" style="font-size: .8em"></span></h1><br/>
    <p class="text-center" style="margin: 0px 5% 15px">This Shopping Cart is live for testing only. <span style="color:red">These products are only place holders.</span> You may order products and even process the orders with stripe! <span style="color:red">No products will be shipped.</span> have Fun!</p>
    @if(Session::has('cart'))
        <div class="container" >
            <div class="well" style="margin: 0px 3% 0px 3%">
                <div class="row">
                    <div class="col-sm-8 col-md-8" style="margin: 0px 0px 0px 0px">
                        @foreach($products as $product)
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <span class="badge">{{ $product['qty'] }}</span>
                                        <b>   {{ $product['item']['name'] }} </b><br/> @ <b> ${{ $product['item']['price']}}</b>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <br/>
                                        <a id="rem" href="/removeItem/{{$product['item']['id']}}" class="btn btn-info btn-sm pull-right">remove</a>
                                    </div>
                                </div>
                            </div>
                         @endforeach
                        <div class="well">
                            <a href="/checkout" class="btn btn-success btn-lg pull-right">Checkout <span class="glyphicon glyphicon-shopping-cart"></span></a>  
                            <span class="badge" style="padding-bottom: 5px"><b>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : ''}}</b></span>
                            <span class=""> Total Price: <b>${{$totalPrice}}</b></span>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="well">
            <h3>You Have No Items In Your Shopping Cart</h3>  
        </div>
    @endif
@endsection
