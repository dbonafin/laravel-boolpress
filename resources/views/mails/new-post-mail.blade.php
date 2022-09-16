<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1> Hi, there is a new post in the feed </h1>

    <a href="{{ route('admin.posts.show', ['post' => $new_post->id]) }}">
        See details
    </a>

</body>
</html>