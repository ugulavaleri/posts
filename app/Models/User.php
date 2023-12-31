<?php

    namespace App\Models;

    // use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'name',
            'email',
            'password',
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

        public function posts()
        {
            return $this->hasMany(Post::class);
        }
        public function comments()
        {
            return $this->hasMany(Comment::class);
        }

        public function favouritePosts()
        {
            return $this->belongsToMany(Post::class, 'favourites');
        }

        public function likedComments()
        {
            return $this->belongsToMany(Comment::class);
        }

        // followers, who follow current authenticated user.
        public function followers()
        {
            return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id');
        }

        // people, who are followed by current authenticated user.
        public function followings()
        {
            return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id');
        }

        public function haveAlreadyFollowed(){
            return auth()->user()->followings->contains($this->id);
        }
    }
