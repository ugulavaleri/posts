<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $comment = $request->validate([
            'comment' => ['required', 'string', 'max:1024']
        ]);
        $comment['user_id'] = auth()->id();
        $post->comments()->create($comment);

        return redirect()->route('dashboard');
    }
    public function toggleLike(Post $post, Comment $comment){
        if (!auth()->user()->likedComments->contains($comment->id)) {
            $comment->usersWhoLikeThisComment()->attach(auth()->id());
        } else {
            $comment->usersWhoLikeThisComment()->detach(auth()->id());
        }
        return redirect()->route('dashboard');
    }

    public function showLikes(Comment $comment){
        return view('comments.index', [
            'comment' => $comment
        ]);
    }

}
