<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('最初の画面') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("ログイン機能作った！") }}
                </div>
            </div>
        </div>
    </div>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Laravel Image Upload</title>
    </head>

    <body>
        @if (session('success'))
        <div>{{ session('success') }}</div>
        @endif

        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image">
            <button type="submit">アップロード</button>
        </form>

        @foreach ($images as $image)
        <img src="{{ asset('storage/uploads/' . $image->filename) }}" alt="アップロードされた画像">
        @endforeach
    </body>

    </html>



</x-app-layout>