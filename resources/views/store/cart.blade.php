@extends('layouts.app') 

@section('content')
    <h1><span class="glyphicon glyphicon-leaf" style="font-size: 1em;"></span>LongLifeStore Cart<span class="glyphicon glyphicon-shopping-cart" style="font-size: .8em"></span></h1>
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6">
                @foreach($products as $product)
                    <div class="well">
                        <span class="badge">{{ $product['qty'] }}</span>
                        <b>   {{ $product['item']['name'] }} </b> @ <b> ${{ $product['item']['price']}}</b>
                        <a id="rem" href="/removeItem/{{$product['item']['id']}}" class="btn btn-info pull-right">Remove</a>
                    </div>
                @endforeach
                <div class="well">
                    <a href="/checkout" class="btn btn-success pull-right">Checkout <span class="glyphicon glyphicon-shopping-cart"></span></a>
                    <span class="badge" style="padding-bottom: 5px"><b>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : ''}}</b></span>
                    <span class=""> Total Price: <b>${{$totalPrice}}</b></span>  
                </div>
            </div>
        </div>
    @else
        <div class="well">
            <h3>You Have No Items In Your Shopping Cart</h3>  
        </div>
    @endif
@endsection
