@extends('layout')

@section('content')
    <h1>Posts</h1>

    @can('create', \App\Models\Post::class)
        <a href=" {{route('admin.post.create')}} " class="btn btn-primary">Add new</a>
    @endcan

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
                <td><a href=" {{route('admin.post.show', ['id' => $post->id])}} " class="btn btn-secondary">View</a></td>
                @can('update', $post)
                    <td><a href=" {{route('admin.post.edit', ['id' => $post->id])}} " class="btn btn-secondary">Update</a></td>
                    <td><a href=" {{route('admin.post.destroy', ['id' => $post->id])}} " class="btn btn-secondary">Delete</a></td>
                @endcan
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>


@endsection
