<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()   // ativa quando construir/iniciar a classe 
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        if ($post->likedBy($request->user())){
            return response(null, 409); // Conflict
            //return back();
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()){

            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return back();
    } 

    public function destroy(Post $post, Request $request)
    {
   
        
        $last_post_id = $request->user()->likes()
                //->withTrashed()
                ->where('post_id', $post->id)
                ->latest()
                ->limit(1);

        $request->user()
                ->likes()
                //->withTrashed()   
                ->where('post_id', $post->id)   
                ->whereNotIn ('id', [( $last_post_id->get('id') )     ->toArray() ] )       
                ->forceDelete();  
                
                // hard delete all likes but the last
        
        $request->user()->likes()->where('post_id', $post->id)->delete(); 
        
        return back();
    }
}
