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
    <img src="{{ route('show.image', ['filename' => $image->filename]) }}" alt="画像">
    @endforeach
</body>

</html>