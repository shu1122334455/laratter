<!-- resources/views/tweet/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Tweet Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
                    <div class="mb-6">
                        <div class="flex flex-col mb-4">
                            <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Tweet</p>
                            <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="tweet">
                                {{$tweet->tweet}}
                            </p>
                        </div>
                        <div class="flex flex-col mb-4">
                            <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Description</p>
                            <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                                {{$tweet->description}}
                            </p>
                        </div>
                        <!-- ツイートの内容などの表示 -->
                        <div class="tweet-content">

                            <p class="text-gray-800 dark:text-gray-200">{{ $tweet->created_at->format('Y-m-d H:i') }}</p>

                        </div>
                        <!-- 🔽 更新ボタン -->
                        <form action="{{ route('tweet.edit',$tweet->id) }}" method="GET" class="text-left">
                            @csrf
                            <x-primary-button class="ml-3">
                                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="gray">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </x-primary-button>
                        </form>




                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ url()->previous() }}">
                                <x-secondary-button class="ml-3">
                                    {{ __('Back') }}
                                    </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>