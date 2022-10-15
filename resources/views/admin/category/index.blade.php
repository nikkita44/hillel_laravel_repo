@extends('layout')

@section('content')
    <h1>Categories</h1>
    <a href=" {{route('admin.category.create')}} " class="btn btn-primary">Add new</a>

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

        @forelse($categories as $category)
            <tr>
                <td>{{$category->title}}</td>
                <td>{{$category->slug}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td><a href=" {{route('admin.category.edit', ['id' => $category->id])}} " class="btn btn-secondary">Update</a></td>
                <td><a href=" {{route('admin.category.destroy', ['id' => $category->id])}} " class="btn btn-secondary">Delete</a></td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>


@endsection
