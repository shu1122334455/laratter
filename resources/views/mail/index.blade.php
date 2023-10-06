<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Send mail') }}
        </h2>
    </x-slot>
    <form action="{{ url('mail') }}" method='POST'>
        @csrf
        <div class="form-group">

            <p>名前</p>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            @if ($errors->has('name'))
            <p class="bg-danger">{{ $errors->first('name') }}</p>
            @endif

            <p>メッセージ</p>
            <input type="text" name="message" value="{{ old('message') }}" class="form-control">
            @if ($errors->has('message'))
            <p class="bg-danger">{{ $errors->first('message') }}</p>
            @endif

            <div class="flex items-center justify-start mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Send') }}
                </x-primary-button>
            </div>

        </div>
    </form>


    @if (Session::has('success'))
    <div>
        <p class="bg-warning text-center">{{ Session::get('success')}}</p>
    </div>
    @endif
</x-app-layout>