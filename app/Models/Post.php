<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function favourites(){
        return $this->belongsToMany(User::class,'favourites');
    }

    public function usersWhoMarkAsAFavourite(){
        return $this->belongsToMany(User::class,'favourites');
    }
    public function isMarkedAsAFavouritePost(){
        return $this->favourites()->where('user_id',auth()->id())->exists();
    }
}
