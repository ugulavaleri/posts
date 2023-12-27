<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = $request->validated();
        $comment['user_id'] = auth()->id();
        $post->comments()->create($comment);

        return redirect()->route('dashboard');
    }
    public function toggleLike(Post $post, Comment $comment){
        if (!$comment->isLikedByCurrentUser()) {
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
