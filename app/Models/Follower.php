<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Follower extends Model
    {
        use HasFactory;

        public function followers()
        {
            return $this->belongsToMany(Follower::class, 'follower_user', 'follower_id', 'user_id');
        }
    }
