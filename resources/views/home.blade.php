<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <h1>Articles</h1>

    <h2>{{ isset($article) ? 'Edit' : 'Create' }} Article</h2>

    <form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST">
        @csrf
        @if(isset($article))
            @method('PUT')
        @endif

        <div>
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $article->name ?? '') }}" required>
        </div>

        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" required>{{ old('content', $article->content ?? '') }}</textarea>
        </div>

        <div>
            <label for="tags">Tags</label>
            <div id="tags">
                @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @if(isset($article) && $article->tags->contains($tag->id)) checked @endif>
                        {{ $tag->name }}
                    </label><br>
                @endforeach
            </div>
        </div>

        <button type="submit">{{ isset($article) ? 'Update' : 'Create' }} Article</button>
    </form>

    <hr>

    <h2>All Articles</h2>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>content</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->content }}</td>
                    <td> {{ $article->tags->pluck('name')->implode(', ') }}</td>
                    <td>
                        <a href="{{ route('articles.edit', $article) }}">
                            <button>Edit</button>
                        </a>


                        <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>