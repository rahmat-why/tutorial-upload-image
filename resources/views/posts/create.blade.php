<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <h1>Create Post</h1>

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

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="content">Content:</label>
        <textarea name="content" rows="4" required></textarea>

        <label for="image">Image:</label>
        <input type="file" name="image">

        <button type="submit">Create Post</button>
    </form>
</body>
</html>
