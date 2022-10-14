@extends('layout')

@section('content')
    <h1>{{ $author->name }}</h1>
    <h2>{{ $category->title }}</h2>

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

        @forelse($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('author.category.tag.posts', ['id' => $post->user->id, 'category_id' => $post->category->id, 'tag_id' => $tag->id]) }}">{{$tag->title}}, </a>
                    @endforeach
                </td>
                <td>{{$post->category->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>
@endsection
