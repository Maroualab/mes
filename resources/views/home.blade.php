<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>

<form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST">
        @csrf
        @if (isset($article))
            @method('PUT')
        @endif
        <label for="name">Article Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="tags">Tags:</label>
        <input type="text" id="tags" name="tags" required>

        <button type="submit">Create Article</button>
    </form>

   
    <table>
        <thead>
            <tr>
                <th>article</th>
                <th>tag</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->name }}</td>
                    <td>{{implode(',',[$articles->tags]) }}</td>
                    <td>
                        <button>Edit</button>
                        <form action="{{ route('articles.delete', $article) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>