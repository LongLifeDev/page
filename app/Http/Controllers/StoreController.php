<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Cart;
use Session;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'storeCart', 'removeItem', 'getCart']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Validate the value...
            $daily = Product::where('is_feature', 1)->take(3)->get();
        } catch (Exception $e) {
            report($e);
            $daily = null;
        }

        try {
            // Validate the value...
            $products = Product::orderBy('created_at', 'desc')->paginate(6);
        } catch (Exception $e) {
            report($e);
            $products = null;
        }
        
        //return view('store.index')->with('products', $products);
        return view('store.index', compact(['daily', 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        
    }

    public function storeCart(Request $request, $id)
    {
        $product = Product::find($id);
        
        $existingCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($existingCart);
        $cart->add($product, $id);
        
        $request->session()->put('cart', $cart);
        return back()->with('success', '1 item added to shopping cart');
        //die dump
        //dd($request->session()->get('cart'));
    }

    public function removeItem($id)
    {   
        $existingCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($existingCart);
        $cart->remove($id);
        if(count($cart->items) > 0){
            Session()->put('cart', $cart); 
        } else {
            Session::forget('cart');
        }
        
        return back()->with('success', 'Item removed');
        //die dump
        //dd($request->session()->get('cart'));
        //return redirect('/posts')->with('success', 'Post Updated');
    }

    public function getCart()
    {
        try {
            // Validate the value...
            if(!Session::has('cart')) {
                return view('store.cart', ['products' => null]);
            } else {
                $existingCart = Session::get('cart');
                $cart = new Cart($existingCart);
                return view('store.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
            }
        } catch (Exception $e) {
            report($e);
            return redirect('store')->with('error', 'There is an error with Cart.');
        }
        
    }

    public function getCheckout()
    {
        try {
            // Validate the value...
            if(!Session::has('cart')) {
                return back()->with('success', 'ShoppingCart Empty!');
            } else {
                $existingCart = Session::get('cart');
                $cart = new Cart($existingCart);
                $total = ($cart->totalPrice * 100);
                }
        } catch (Exception $e) {
            report($e);
            return redirect('store')->with('error', 'There is an error with checkout');
        }

        //view for stripe checkout
        //return view('/store/checkout', ['products' => $cart->items, 'total' => $total]);

        //view for stripe elements
        return view('/store/elements', ['products' => $cart->items, 'total' => $total]);

    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Validate the value...
            $product = Product::find($id);
        } catch (Exception $e) {
            report($e);
            return redirect('store')->with('error', 'Could not find that item');
        }

        return view('store.show')->with('product', $product);
    }
        

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
