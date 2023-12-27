<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex justify-end mt-4">
        <ul class="max-w-xl w-full mx-auto">
            @if($followers->count())
                <h1 class="text-center mb-5 text-xl text-slate-50">Followers</h1>
                @foreach($followers as $follower)
                    <li class="bg-gray-800 mb-2 p-2 rounded-xl">
                        <div class="flex items-center justify-between gap-7 mb-1">
                            <p class="text-slate-50">{{ $follower->name }}</p>
                            <p class="text-slate-50">{{ $follower->id }}</p>
                        </div>
                    </li>
                @endforeach
            @else
                <h1 class="text-center text-xl text-slate-50 mt-10">You haven't any Follower 🫤</h1>
            @endif
        </ul>
    </div>
</x-app-layout>
