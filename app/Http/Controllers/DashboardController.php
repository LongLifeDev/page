<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $posts = $user->posts;
        $daily = Product::where('is_feature', 1)->take(4)->get();
        return view('dashboard', compact(['daily', 'posts']));
        //return view('dashboard')->with('posts', $user->posts);
        //$products = Product::orderBy('created_at', 'desc')->paginate(6);
        //return view('store.index')->with('products', $products);
        
    }
}
