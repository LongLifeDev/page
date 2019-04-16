<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(4);
        return view('/blog/index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/blog/create');
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
            'title' => 'required',
            'title_description' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'secondary_image' => 'image|nullable|max:1999'
        ]);

        //handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request -> file('cover_image')->getClientOriginalName();    
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->hasFile('secondary_image')){
            //Get filename with the extension
            $filenameWithExt2 = $request -> file('secondary_image')->getClientOriginalName();    
            //Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            //Get just ext
            $extension2 = $request->file('secondary_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 = $filename2.'_'.time().'.'.$extension2;
            //Upload Image
            $path2 = $request->file('secondary_image')->storeAs('public/cover_images', $fileNameToStore2);
            
        } else {
            $fileNameToStore2 = 'noimage.jpg';
        }

        //Create post using Tinker
        $post = new Post;
        $post->title = $request->input('title');
        $post->title_description = $request->input('title_description');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->secondary_image = $fileNameToStore2;
        $post->save();

        // redirect with success message
        return redirect('/dashboard')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('/blog/show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(Auth::user()->id !==$post->user_id){
           return redirect('/posts')->with('error', 'unauthorized Page');
        }

        return view('/blog/edit')->with('post', $post);
    } 

    public function editBlog($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'unauthorized Page');
            //return view('/blog/edit')->with('post', $post); 
        }
        
        return view('/blog/edit')->with('post', $post);
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
            'title' => 'required',
            'title_description' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'secondary_image' => 'image|nullable|max:1999'
        ]);
        
        //handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request -> file('cover_image')->getClientOriginalName();    
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            
        }

        if($request->hasFile('secondary_image')){
            //Get filename with the extension
            $filenameWithExt2 = $request -> file('secondary_image')->getClientOriginalName();    
            //Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            //Get just ext
            $extension2 = $request->file('secondary_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 = $filename2.'_'.time().'.'.$extension2;
            //Upload Image
            $path2 = $request->file('secondary_image')->storeAs('public/cover_images', $fileNameToStore);
            
        }

        // create post using Tinker
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->title_description = $request->input('title_description');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        if($request->hasFile('secondary_image')){
            $post->secondary_image = $fileNameToStor2e;
        }
        $post->save();

        // redirect with success message
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        //Check for correct user
        if(Auth::user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
