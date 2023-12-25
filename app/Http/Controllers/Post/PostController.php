<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['comments.user','user'])->get();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storeComment(Request $request,Post $post){
        $comment = $request->validate([
            'comment' => ['required','string','max:1024']
        ]);
        $comment['user_id'] = auth()->id();
        $post->comments()->create($comment);

        return redirect()->route('dashboard');
    }
    public function markAsFavourite(Request $request,Post $post){
        if(!auth()->user()->likes()->where('post_id', $post->id)->exists()){
            $post->likes()->attach([
                'user_id' => auth()->id()
            ]);
        }else{
            $like = $post->likes()->where('user_id',auth()->id());
            dd($like);
            $like->delete();
        }
//        dd();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        dd($post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
