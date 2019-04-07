<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Product;

class InventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name', 'desc')->paginate(10);
        return view('inventory.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'catagory' => 'required',
            'name' => 'required',
            'title' => 'required',
            'price' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'product_info' => 'required', 
            'code' => 'required',
            'product_image_main' => 'image|nullable|max:1999',
            'product_image_secondary' => 'image|nullable|max:1999'
        ]);

        //handle File Upload
        if($request->hasFile('product_image_main')){
            //Get filename with the extension
            $filenameWithExt = $request -> file('product_image_main')->getClientOriginalName();    
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('product_image_main')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('product_image_main')->storeAs('public/product_images', $fileNameToStore);
            
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->hasFile('product_image_secondary')){
            //Get filename with the extension
            $filenameWithExt2 = $request -> file('product_image_secondary')->getClientOriginalName();    
            //Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            //Get just ext
            $extension2 = $request->file('product_image_secondary')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 = $filename2.'_'.time().'.'.$extension2;
            //Upload Image
            $path2 = $request->file('product_image_secondary')->storeAs('public/product_images', $fileNameToStore2);
            
        } else {
            $fileNameToStore2 = 'noimage.jpg';
        }

        //Create post using Tinker
        $product = new Product;
        $product->catagory = $request->input('catagory');
        $product->name = $request->input('name');
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->cost = $request->input('cost');
        $product->description = $request->input('description');
        $product->product_info = $request->input('product_info');
        $product->code = $request->input('code');
        $product->user_id = auth()->user()->id;
        $product->product_image_main = $fileNameToStore;
        $product->product_image_secondary = $fileNameToStore2;
        $product->save();

        // redirect with success message
        return redirect('/dashboard')->with('success', 'Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('/inventory/show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        //Check for correct user
        if(Auth::user()->status < 3){
            return redirect('/store')->with('error', 'unauthorized Page');
        }

        return view('inventory.edit')->with('product', $product);
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
        $this->validate($request, [
            'catagory' => 'required',
            'name' => 'required',
            'title' => 'required',
            'price' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'product_info' => 'required', 
            'code' => 'required', 
            'product_image_main' => 'image|nullable|max:1999',
            'product_image_secondary' => 'image|nullable|max:1999'
        ]);
        
        //handle File Upload
        if($request->hasFile('product_image_main')){
            //Get filename with the extension
            $filenameWithExt = $request -> file('product_image_main')->getClientOriginalName();    
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('product_image_main')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('product_image_main')->storeAs('public/product_images', $fileNameToStore);
            
        }

        if($request->hasFile('product_image_secondary')){
            //Get filename with the extension
            $filenameWithExt2 = $request -> file('product_image_secondary')->getClientOriginalName();    
            //Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            //Get just ext
            $extension2 = $request->file('product_image_secondary')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 = $filename2.'_'.time().'.'.$extension2;
            //Upload Image
            $path2 = $request->file('product_image_secondary')->storeAs('public/product_images', $fileNameToStore2);
            
        }

        

        // create product using Tinker
        $product = Product::find($id);

        //is_feature check
        if(null !== ($request->input('is_feature'))){
            $product->is_feature = $request->input('is_feature');
        }else{
            $product->is_feature = null;
        };

        $product->catagory = $request->input('catagory');
        $product->name = $request->input('name');
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->cost = $request->input('cost');
        $product->description = $request->input('description');
        $product->product_info = $request->input('product_info');
        $product->code = $request->input('code');
        $product->user_id = auth()->user()->id;
        if($request->hasFile('product_image_main')){
            $product->product_image_main = $fileNameToStore;
        }
        if($request->hasFile('product_image_secondary')){
            $product->product_image_secondary = $fileNameToStore2;
        }
        $product->save();

        // redirect with success message
        return redirect('/dashboard')->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        //Check for correct user
        if(Auth::user()->id !==$product->user_id){
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        if($product->product_image_main != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/product_images/'.$product->product_image_main);
        }

        if($product->product_image_secondary != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/product_images/'.$product->product_image_secondary);
        }

        $product->delete();
        return redirect('/inventory')->with('success', 'Product Removed');
    }
}
