<!-- resources/views/posts/show.blade.php -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            color: #555;
            line-height: 1.6;
            font-size: 1.1em;
        }

        .comment-section {
            margin-top: 30px;
        }

        .comment-section h3 {
            color: #333;
        }

        .comment-section ul {
            list-style-type: none;
            padding-left: 0;
        }

        .comment-section li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            resize: vertical;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <div class="comment-section">
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <textarea name="content" placeholder="Введите комментарий" required></textarea>
            <button type="submit">Добавить комментарий</button>
        </form>

        <h3>Комментарии:</h3>
        <ul>
            @foreach($post->comments as $comment)
                <li>{{ $comment->content }}</li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('posts.index') }}" class="btn-back">Назад к списку постов</a>
</div>

</body>
</html>
