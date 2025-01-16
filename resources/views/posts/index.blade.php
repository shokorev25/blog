<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блог</title>
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
            text-align: center;
            color: #333;
        }

        .post {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .post h3 {
            color: #333;
        }

        .post p {
            color: #555;
            margin-bottom: 10px;
        }

        .actions button {
            margin-right: 10px;
            padding: 8px 16px;
            font-size: 14px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions button:hover {
            background-color: #45a049;
        }

        .comments-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .comments-section ul {
            list-style-type: none;
            padding-left: 0;
        }

        .comments-section li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .comment-actions button {
            margin-left: 10px;
            background-color: #ff5722;
            border: none;
        }

        .comment-actions button:hover {
            background-color: #e64a19;
        }

        .comment-actions form {
            display: inline-block;
        }

        .post form {
            margin-top: 10px;
        }

        .post textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .post a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 4px;
        }

        .post a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Публикации</h1>
    <a href="{{ route('posts.create') }}">Создать пост</a>

    <ul>
        @foreach($posts as $post)
            <li class="post">
                <h3>{{ $post->title }}</h3>
                <p>{{ Str::limit($post->content, 100) }}</p>
                
                <div class="actions">
                    <a href="{{ route('posts.edit', $post->id) }}">Редактировать</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                    <form action="{{ route('posts.toggle-publish', $post) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit">{{ $post->is_published ? 'Снять с публикации' : 'Опубликовать' }}</button>
                    </form>
                </div>

                @if ($post->is_published)
                    <div class="comments-section">
                        <h4>Комментарии:</h4>
                        <ul>
                            @foreach($post->comments as $comment)
                                <li>
                                    {{ $comment->content }}
                                    <div class="comment-actions">
                                        @if (!$comment->is_approved)
                                            <form action="{{ route('comments.approve', $comment) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit">Одобрить</button>
                                            </form>
                                            <form action="{{ route('comments.reject', $comment) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit">Удалить</button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <textarea name="content" required placeholder="Добавьте комментарий..."></textarea>
                            <button type="submit">Добавить комментарий</button>
                        </form>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>

</body>
</html>
