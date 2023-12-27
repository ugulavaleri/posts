<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function usersWhoLikeThisComment(){
        return $this->belongsToMany(User::class);
    }

    public function isLikedByCurrentUser(){
        return auth()->user()->likedComments->contains($this->id);
    }
}
