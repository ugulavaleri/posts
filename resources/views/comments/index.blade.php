<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex justify-end mt-4">
        <ul class="max-w-xl w-full mx-auto">
            <h1 class="text-center mb-5 text-xl text-slate-50">Comment Likes</h1>
            @foreach($comment->usersWhoLikeThisComment as $user)
                <li class="bg-gray-800 mb-2 p-2 rounded-xl">
                    <div class="flex items-center justify-between gap-7 mb-1">
                        <p class="text-slate-50">{{ $user->name }}</p>
                        <p class="text-slate-50">{{ $user->id }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
