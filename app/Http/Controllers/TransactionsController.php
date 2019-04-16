<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Transaction;
use Session;

class TransactionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Check for correct user
        if(!Auth::guest()){
            if(Auth::user()->status < 3){
                return redirect('/')->with('error', 'unauthorized Page');
            }
        } else {
            return redirect('/')->with('error', 'unauthorized Page');
            }

        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(50);
        return view('/transactions/index')->with('transactions', $transactions);
        
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
        dd($request->all());
    }

    public function storeTransaction($data)
    {
        dd($data->all());
    } 

    
    public function getChargeElements(Request $request, $total)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'name_on_card' => 'string|required',
            'address_zip' => 'integer|required',
            'address_line1' =>  'required',
            'address_line2' =>  '',
            'address_city' => 'required',
            'address_state' => 'required',
            'address_country' => 'string',
        ]);

        

        // Set your secret key: remember to change this to your live secret key in transactionion
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        try {
            \Stripe\Stripe::setApiKey("sk_test_an1A0SN2NEATGRVbOEMbxiUL008bSM0Wom");

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];
            $email = $_POST['email'];
            $trnsctn_id = ((auth()->user()->id).time());

            $charge = \Stripe\Charge::create([
                'amount' => $total,
                'currency' => 'usd',
                'description' => 'LongLifeStore Payment for '.$email,
                'source' => $token,
                'statement_descriptor' => 'LLM',
            ]);            
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network problem, perhaps try again.
            return redirect('store')->with('error', 'Network problems. Please try again later.');
        } catch (\Stripe\Error\InvalidRequest $e) {
            // You screwed up in your programming. Shouldn't happen!
            return redirect('store')->with('error', 'System Error!');
        } catch (\Stripe\Error\Api $e) {
            // Stripe's servers are down!
            return redirect('store')->with('error', 'Servers Down.'); 
        } catch (\Stripe\Error\Card $e) {
            // Card was declined.
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            // Use $error['message'].
            return redirect('store')->with('error', $error['message']);
        };
        $tax = ($total*.09);
        //Create post using Tinker
        $transaction = new Transaction;
        $transaction->user_id = auth()->user()->id;
        $transaction->trnsctn_id = $trnsctn_id;
        $transaction->stripe_id = $request->input('stripeToken');
        $transaction->user_email = $email;
        $transaction->ammount = ($total/100);
        $transaction->tax = $tax;
        $transaction->shipping = 5.00;
        $transaction->product_id = 1;
        $transaction->paid = 1;
        $transaction->user_name = $request->input('name_on_card');
        $transaction->address_1 = $request->input('address_line1');
        $transaction->address_2 = $request->input('address_line2');
        $transaction->city = $request->input('address_city');
        $transaction->state = $request->input('address_state');
        $transaction->zip = $request->input('address_zip');
        $transaction->country = $request->input('address_country');
        $transaction->save();

        Session::forget('cart');
        return redirect('store')->with('success', 'you have successfully charged $'.number_format ( $total/100, 2, '.', ' ').' to your Credit Card.');

        
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
            $transaction = transaction::find($id);
        } catch (Exception $e) {
            report($e);
            return redirect('store')->with('error', 'Could not find that item');
        }

        return view('store.show')->with('transaction', $transaction);
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

    public function getChargeCheckout($total)
    {
        try {
            require_once('./stripeconfig.php');

            $token = $_POST['stripeToken'];
            $email = $_POST['stripeEmail'];

            $customer = \Stripe\Customer::create([
                'email' => $email,
                'source'  => $token,
            ]);

            $charge = \Stripe\Charge::create([
                'customer' => $customer->id,
                'amount'   => $total,
                'currency' => 'usd',
            ]);   

        } catch (\Stripe\Error\ApiConnection $e) {
            // Network problem, perhaps try again.
            return redirect('store')->with('error', 'Network problems. Please try again later.');
        } catch (\Stripe\Error\InvalidRequest $e) {
            // You screwed up in your programming. Shouldn't happen!
            return redirect('store')->with('error', 'System Error!');
        } catch (\Stripe\Error\Api $e) {
            // Stripe's servers are down!
            return redirect('store')->with('error', 'Servers Down.'); 
        } catch (\Stripe\Error\Card $e) {
            // Card was declined.
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            // Use $error['message'].
            return redirect('store')->with('error', $error['message']);
        };
        Session::forget('cart');
        return redirect('store')->with('success', 'you have successfully charged '.$total.' to your Credit Card.');
    }
}
