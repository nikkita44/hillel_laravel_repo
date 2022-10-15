@extends('layout')

@section('content')
    <h1>Updating Category</h1>

    <form action="{{route('admin.category.update')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$category->id}}" name="id">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$category->title}}">
        </div>
        @if($errors->has('title'))
            @foreach($errors->get('title') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="slug" class="form-label">Some info</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}">
        </div>
        @if($errors->has('slug'))
            @foreach($errors->get('slug') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
