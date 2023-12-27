<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach($favouritePosts as $favouritePost)
            <div>
                <div class="max-w-3xl mx-auto p-5 text-slate-50 font-medium mb-4">
                    <div class="font-bold text-xl mb-1 flex justify-between">
                        <p>{{ $favouritePost->title }}</p>
                        <form action="{{ route('posts.markAsFavourite', $favouritePost) }}" method="POST">
                            @csrf
                            @if(!$favouritePost->isMarkedAsAFavouritePost())
                                <button class="text-sm">Mark As Favourite ⭐</button>
                            @else
                                <button class="text-sm">Marked As Favourite 💫</button>
                            @endif
                        </form>
                    </div>
                    <div class="text-xs text-slate-500">
                        <span>writer -
                            <a href="{{ route('users.show', $favouritePost->user ) }}">
                                {{ $favouritePost->user->name }}
                            </a>
                        </span>
                    </div>
                    <div class="font-thin text-sm">
                        <p>{{ $favouritePost->post }}</p>
                    </div>

                    <div class="flex justify-end mt-4">
                        <ul class="max-w-xl">
                            @foreach($favouritePost->comments as $comment)
                                <li class="bg-gray-800 mb-2 p-2 rounded-xl">
                                    <div class="flex items-center justify-between gap-7 mb-1">
                                        <p>{{ $comment->comment }}</p>
                                        @if($comment->user->id === $favouritePost->user_id)
                                            <span class="text-xs text-green-500">Author</span>
                                        @endif
                                    </div>
                                    <div class="text-slate-500 text-xs">
                                        <a href="{{ route("users.show", $comment->user) }}">{{ $comment->user->name }}</a>
                                        <span class="ml-3">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mt-3 flex justify-end items-center gap-2">

                                        <a href="{{ route('comments.showLikes',$comment) }}">{{ $comment->users_who_like_this_comment_count }}
                                            👤</a>
                                        <form
                                            action="{{ route('comments.likeComment', ['post' => $favouritePost, 'comment' => $comment]) }}"
                                            method="POST">
                                            @csrf
                                            @if(!$comment->isLikedByCurrentUser())
                                                <button
                                                    class="text-sm px-3 py-1 bg-amber-100 rounded-2xl text-slate-500">
                                                    like
                                                </button>
                                            @else
                                                <button
                                                    class="text-sm px-3 py-1 bg-amber-100 rounded-2xl text-slate-500">
                                                    Unlike
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                            <form action="{{ route('posts.comments.store', $favouritePost) }}" method="POST">
                                @csrf
                                <textarea class="w-full bg-transparent mt-8 resize-none" placeholder="Add Comment.."
                                          name="comment"></textarea>
                                <div class="flex justify-end mt-3">
                                    <button class="px-6 py-2 rounded-md bg-slate-50 text-gray-900">Comment</button>
                                </div>
                            </form>
                        </ul>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
