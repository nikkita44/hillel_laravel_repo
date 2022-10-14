@extends('layout')

@section('content')

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
                        <a href="{{ route('tag.posts', ['id' => $tag->id]) }}">{{$tag->title}}, </a>
                    @endforeach
                </td>
                <td><a href="{{ route('category.posts', ['id' => $post->category->id]) }}">{{$post->category->title}}</a></td>
                <td><a href="{{ route('author.posts', ['id' => $post->user->id]) }}">{{$post->user->name}}</a></td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>
@endsection
