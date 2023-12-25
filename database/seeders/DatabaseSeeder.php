<?php

    namespace Database\Seeders;

    // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use App\Models\Comment;
    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            $users = User::factory(10)->create();


            foreach ($users as $user) {
                Post::factory(random_int(1, 10))->create([
                    'user_id' => $user->id
                ]);
            }
            $posts = Post::with('user')->get();

            for ($i = 0;$i < 300;$i++){
                Comment::factory()->create([
                    'post_id' => $posts->random(),
                    'user_id' => $users->random()
                ]);
            }
        }
    }
