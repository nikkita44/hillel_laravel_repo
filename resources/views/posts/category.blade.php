@extends('layout')

@section('content')
    <h1>{{ $category->title }}</h1>

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

        @forelse($category_posts as $category_post)
            <tr>
                <td>{{$category_post->title}}</td>
                <td>{{$category_post->body}}</td>
                <td>{{$category_post->category->title}}</td>
                <td>{{$category_post->user->name}}</td>
                <td>{{$category_post->created_at}}</td>
                <td>{{$category_post->updated_at}}</td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>
@endsection
