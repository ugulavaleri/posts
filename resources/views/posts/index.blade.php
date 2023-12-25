<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach($posts as $post)
            <div>
                <div class="max-w-3xl mx-auto p-5 text-slate-50 font-medium mb-4">
                    <div class="font-bold text-xl mb-1 flex justify-between">
                        <p>{{ $post->title }}</p>
                        <form action="{{ route('posts.markAsFavourite', $post) }}" method="POST">
                            @csrf
                            @if(!$post->isMarkedAsAFavouritePost())
                                <button class="text-sm">Mark As Favourite ⭐</button>
                            @else
                                <button class="text-sm">Marked As Favourite 💫</button>
                            @endif
                        </form>
                    </div>
                    <div class="text-xs text-slate-500">
                        <span>writer - {{ $post->user->name }}</span>
                    </div>
                    <div class="font-thin text-sm">
                        <p>{{ $post->post }}</p>
                    </div>

                    <div class="flex justify-end mt-4">
                        <ul class="max-w-xl">
                            @foreach($post->comments as $comment)
                                <li class="bg-gray-800 mb-2 p-2 rounded-xl">
                                    <div class="flex items-center justify-between gap-7 mb-1">
                                        <p>{{ $comment->comment }}</p>
                                        @if($comment->user->id === $post->user_id)
                                            <span class="text-xs text-green-500">Author</span>
                                        @endif
                                    </div>
                                    <div class="text-slate-500 text-xs">
                                        <span>{{ $comment->user->name }}</span>
                                        <span class="ml-3">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mt-3 flex justify-end items-center gap-2">
                                        <span>0 👤</span>
                                        <button class="text-sm px-3 py-1 bg-amber-100 rounded-2xl text-slate-500">like
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                            <form action="{{ route('posts.storeComment', $post) }}" method="POST">
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
