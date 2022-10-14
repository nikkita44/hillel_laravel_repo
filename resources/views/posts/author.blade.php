@extends('layout')

@section('content')
    <h1>{{ $author->name }}</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Tags</th>
            <th scope="col">Category</th>
            <th scope="col">User</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
        </tr>
        </thead>
        <tbody>

        @forelse($author_posts as $author_post)
            <tr>
                <td>{{$author_post->title}}</td>
                <td>{{$author_post->body}}</td>
                <td>{{$author_post->tags->pluck('title')->join(', ')}}</td>
                <td><a href="{{ route('author.category.posts', ['id' => $author_post->user->id, 'category_id' => $author_post->category->id]) }}">{{$author_post->category->title}}</a></td>
                <td>{{$author_post->user->name}}</td>
                <td>{{$author_post->created_at}}</td>
                <td>{{$author_post->updated_at}}</td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>
@endsection
