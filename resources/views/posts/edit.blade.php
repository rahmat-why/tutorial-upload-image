<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div>
            <strong>Error:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $post->title }}" required>

        <label for="content">Content:</label>
        <textarea name="content" rows="4" required>{{ $post->content }}</textarea>

        <label for="image">Image:</label>
        <input type="file" name="image">
        <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" style="max-width: 300px;">

        <button type="submit">Update Post</button>
    </form>
</body>
</html>
