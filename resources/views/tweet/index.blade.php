<!-- resources/views/tweet/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tweet Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
                    <table class="text-center w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">tweet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tweets as $tweet)
                            <tr class="hover:bg-gray-lighter">
                                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                                    <div class="flex">
                                        <!-- 🔽 編集 -->
                                        <a href="{{ route('follow.show', $tweet->user->id) }}">
                                            <p class="text-left text-gray-dark dark:text-gray-200">{{$tweet->user->name}}</p>
                                        </a>
                                        <!-- 🔼 ここまで -->
                                        <p class="text-left text-gray-800 dark:text-gray-200">{{$tweet->user->name}}</p>
                                        <!-- follow 状態で条件分岐 -->
                                        @if(Auth::user()->followings()->where('users.id', $tweet->user->id)->exists())
                                        <!-- unfollow ボタン -->
                                        <form action="{{ route('unfollow', $tweet->user) }}" method="POST" class="text-left">
                                            @csrf
                                            <x-primary-button class="ml-3">
                                                <svg class="h-6 w-6 text-red-500" fill="yellow" viewBox="0 0 24 24" stroke="red">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                                                </svg>
                                                {{ $tweet->user->followers()->count() }}
                                            </x-primary-button>
                                        </form>
                                        @else
                                        <!-- follow ボタン -->
                                        <form action="{{ route('follow', $tweet->user) }}" method="POST" class="text-left">
                                            @csrf
                                            <x-primary-button class="ml-3">
                                                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="gray">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                                                </svg>
                                                {{ $tweet->user->followers()->count() }}
                                            </x-primary-button>
                                        </form>
                                        @endif
                                    </div>
                                    <a href="{{ route('tweet.show',$tweet->id) }}">
                                        <h3 class="text-left font-bold text-lg text-gray-800 dark:text-gray-200">{{$tweet->tweet}}</h3>
                                    </a>
                                    <!-- 🔼 ここまで編集 -->
                                    <a href="{{ route('tweet.show',$tweet->id) }}">
                                        <p class="text-left text-gray-800 dark:text-gray-200">{{$tweet->user->name}}</p>
                                        <h3 class="text-left font-bold text-lg text-gray-800 dark:text-gray-200">{{$tweet->tweet}}</h3>
                                    </a>
                                    <div class="flex">
                                        <!-- 🔽 追加 -->
                                        <!-- favorite 状態で条件分岐 -->
                                        @if($tweet->users()->where('user_id', Auth::id())->exists())
                                        <!-- unfavorite ボタン -->
                                        <form action="{{ route('unfavorites',$tweet) }}" method="POST" class="text-left">
                                            @csrf
                                            <x-primary-button class="ml-3">
                                                <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                {{ $tweet->users()->count() }}
                                            </x-primary-button>
                                        </form>
                                        @else
                                        <!-- favorite ボタン -->
                                        <form action="{{ route('favorites',$tweet) }}" method="POST" class="text-left">
                                            @csrf
                                            <x-primary-button class="ml-3">
                                                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="gray">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                {{ $tweet->users()->count() }}
                                            </x-primary-button>
                                        </form>
                                        @endif
                                        <div class="flex">
                                            <p class="text-left text-gray-800 dark:text-gray-200">{{$tweet->user->name}}</p>
                                            <!-- 見ました 状態で条件分岐 -->
                                            @if(Auth::user()->followings()->where('users.id', $tweet->user->id)->exists())
                                            <!-- 見ました ボタン -->
                                            <form action="{{ route('unfollow', $tweet->user) }}" method="POST" class="text-left">
                                                @csrf
                                                <x-primary-button class="ml-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    {{ $tweet->user->followers()->count() }}
                                                </x-primary-button>
                                            </form>
                                            @else
                                            <!-- follow ボタン -->
                                            <form action="{{ route('follow', $tweet->user) }}" method="POST" class="text-left">
                                                @csrf
                                                <x-primary-button class="ml-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    {{ $tweet->user->followers()->count() }}
                                                </x-primary-button>
                                            </form>
                                            @endif
                                        </div>
                                        <a href="{{ route('tweet.show',$tweet->id) }}">
                                            <h3 class="text-left font-bold text-lg text-gray-800 dark:text-gray-200">{{$tweet->tweet}}</h3>
                                        </a>
                                        <!-- 🔽 条件分岐でログインしているユーザが投稿したtweetのみ編集ボタンと削除ボタンが表示される -->
                                        @if ($tweet->user_id === Auth::user()->id)
                                        <!-- 更新ボタン -->
                                        <form action="{{ route('tweet.edit',$tweet->id) }}" method="GET" class="text-left">
                                            @csrf
                                            <x-primary-button class="ml-3">
                                                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="gray">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </x-primary-button>
                                        </form>
                                        <!-- 削除ボタン -->
                                        <form action="{{ route('tweet.destroy',$tweet->id) }}" method="POST" class="text-left">
                                            @method('delete')
                                            @csrf
                                            <x-primary-button class="ml-3">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </x-primary-button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>