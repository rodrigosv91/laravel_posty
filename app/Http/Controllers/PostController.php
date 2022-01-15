<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller 
{

    public function __construct()
    {
        //$this->middleware(['auth'])->except(['index', 'show']);
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        //$posts = Post::get(); // Return Laravel Collection (*) | Post::where() // Post::find()

        $posts = Post::latest()->with(['user', 'likes'])->paginate(20); //Return LengthAwarePaginator obj, which contains a collection
                                                             //eager load  User and Like relationship with Post
                                                            //latest() == orderBy('created_at', 'desc')  
       

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post) //show one post
    {    
        //$post2 = Post::find($post); // if post as int id
  
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required' 
        ]);
        
        //alternative 1
        // Post::create([    //       
        //     'user_id' => auth()->id(), // <=shortcut | long form: 'user_id'=> auth()->user()->id;
        //     'body' => $request->body
        // ]);                             

        //alternative 2 
        //auth()->user()->posts()->create(); // what we want to do // possible due to ManyToMany relationship

        // $request->user()->posts()->create([
        //     'body' => $request->body
        // ]);

        $request->user()->posts()->create($request->only('body'));  //short of alt 2

        return back();
    }

    public function destroy(Post $post)
    {
        // if(!$post->ownedBy(auth()->user())){
        //     dd('no'); } // deny //trhow exception  or error     

        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
        ]);

        $search = $request->input('search');

        //$posts = Post::latest()->where('body', 'LIKE', "%{$search}%")->paginate(20);  //search only posts     

        $posts = Post::latest('posts.created_at')
        ->join('users', function ($join) {
            $join->on('users.id', '=', 'posts.user_id');
        }) 
        ->orwhere('body', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->paginate(20); 

        return view('posts.search', [
            'posts' => $posts
        ]);
    }
}
