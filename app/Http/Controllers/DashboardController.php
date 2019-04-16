<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Transaction;

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
        $users = User::orderBy('name', 'desc')->paginate(8);
        $posts = $user->posts;
        
        if ($user->status < 3){
            $daily = null;
            $transactions = $user->transactions;
            return view('dashboard', compact(['transactions', 'posts']));
        } elseif ($user->status == 3){
            $transactions = Transaction::orderBy('created_at', 'desc')->paginate(8);
            $daily = Product::where('is_feature', 1)->take(4)->get();
            return view('dashboardSuper', compact(['daily', 'posts', 'transactions', 'users']));
        }
        
        //return view('dashboard')->with('posts', $user->posts);
        //$products = Product::orderBy('created_at', 'desc')->paginate(6);
        //return view('store.index')->with('products', $products);
        
    }
}
