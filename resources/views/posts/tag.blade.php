@extends('layout')

@section('content')
    <h1>{{ $tag->title }}</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Category</th>
            <th scope="col">User</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
        </tr>
        </thead>
        <tbody>

        @forelse($tag_posts as $tag_post)
            <tr>
                <td>{{$tag_post->title}}</td>
                <td>{{$tag_post->body}}</td>
                <td>{{$tag_post->category->title}}</td>
                <td>{{$tag_post->user->name}}</td>
                <td>{{$tag_post->created_at}}</td>
                <td>{{$tag_post->updated_at}}</td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>
@endsection
