<?php

    namespace App\Http\Controllers\Post;

    use App\Http\Controllers\Controller;
    use App\Models\Comment;
    use App\Models\Favourite;
    use App\Models\Like;
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
            $posts = Post::with(['comments.user', 'user', 'usersWhoMarkAsAFavourite','comments.usersWhoLikeThisComment'])
                ->paginate(10);
            return view('posts.index', compact('posts'));
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

        public function markAsFavourite(Request $request, Post $post)
        {
            if (!auth()->user()->favouritePosts->contains($post->id)) {
                $post->usersWhoMarkAsAFavourite()->attach(auth()->id());
            } else {
                $post->usersWhoMarkAsAFavourite()->detach(auth()->id());
            }
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
