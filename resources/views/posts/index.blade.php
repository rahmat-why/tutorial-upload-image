<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <h1>Posts</h1>
    <a href="{{ route('posts.create') }}">Create New Post</a>

    @foreach ($posts as $post)
        <div>
            <h2>{{ $post->title }} - {{ $post->id }}</h2>
            <p>{{ $post->content }}</p>
            <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" style="max-width: 300px;">
            <p>
                <a href="{{ route('posts.show', $post->id) }}">View</a> |
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a> |
                <!-- Add the following delete link -->
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <a href="javascript:void(0)" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                </form>
            </p>
        </div>
    @endforeach
</body>
</html>
