@extends('layout')

@section('content')
    <h1>Posts</h1>
    <a href=" {{route('admin.post.create')}} " class="btn btn-primary">Add new</a>

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
                        {{$tag->title}},
                    @endforeach
                </td>
                <td>{{$post->category->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td><a href=" {{route('admin.post.edit', ['id' => $post->id])}} " class="btn btn-secondary">Update</a></td>
                <td><a href=" {{route('admin.post.destroy', ['id' => $post->id])}} " class="btn btn-secondary">Delete</a></td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>


@endsection
