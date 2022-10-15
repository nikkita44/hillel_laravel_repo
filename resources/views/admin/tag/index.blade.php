@extends('layout')

@section('content')
    <h1>Tags</h1>
    <a href=" {{route('admin.tag.create')}} " class="btn btn-primary">Add new</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
        </tr>
        </thead>
        <tbody>

        @forelse($tags as $tag)
            <tr>
                <td>{{$tag->title}}</td>
                <td>{{$tag->slug}}</td>
                <td>{{$tag->created_at}}</td>
                <td>{{$tag->updated_at}}</td>
                <td><a href=" {{route('admin.tag.edit', ['id' => $tag->id])}} " class="btn btn-secondary">Update</a></td>
                <td><a href=" {{route('admin.tag.destroy', ['id' => $tag->id])}} " class="btn btn-secondary">Delete</a></td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>


@endsection
