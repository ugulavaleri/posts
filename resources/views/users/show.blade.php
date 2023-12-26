<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex justify-end mt-4">
        <div class="max-w-xl w-full mx-auto">
            <div class="bg-gray-800 mb-2 px-4 py-6 rounded-xl">
                <div class="flex justify-between text-xs text-gray-500">
                    <p class="mb-3">Member of This portal since - {{ $user->created_at->diffForHumans() }}</p>
                    <p>Id: {{ $user->id }}</p>
                </div>
                <p class="text-slate-50 mb-3">Name: <span class="text-xs">{{ $user->name }}</span></p>
                <p class="text-slate-50 mb-3">Email: <span class="text-xs">{{ $user->email }}</span></p>
                <p class="text-slate-50">Number Of posts: <span class="text-xs">{{ $user->posts->count() }}</span></p>
                @if(auth()->id() !== $user->id)
                    <form action="{{ route('users.follow', $user) }}" method="POST" class="flex justify-end">
                        @csrf
                        @if($user->haveAlreadyFollowed())
                            <button class="text-gray-50 bg-amber-600 px-6 py-1 rounded-3xl mt-6 font-extrabold"><span>✔️</span> followed</button>
                        @else
                            <button class="text-gray-50 bg-amber-600 px-6 py-1 rounded-3xl mt-6 font-extrabold"><span>👥</span> follow</button>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

