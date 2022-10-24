@extends('layout')

@section('content')
    <h1>Categories</h1>

    @can('create', \App\Models\Category::class)
        <a href=" {{route('admin.category.create')}} " class="btn btn-primary">Add new</a>
    @endcan

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
                <td><a href=" {{route('admin.category.show', ['id' => $category->id])}} " class="btn btn-secondary">View</a></td>
                @can('update', $category)
                    <td><a href=" {{route('admin.category.edit', ['id' => $category->id])}} " class="btn btn-secondary">Update</a></td>
                    <td><a href=" {{route('admin.category.destroy', ['id' => $category->id])}} " class="btn btn-secondary">Delete</a></td>
                @endcan
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>


@endsection
