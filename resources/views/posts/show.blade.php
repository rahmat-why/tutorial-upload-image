<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Post</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" style="max-width: 300px;">

    <p>
        <a href="{{ route('posts.index') }}">Back to Posts</a>
    </p>
</body>
</html>