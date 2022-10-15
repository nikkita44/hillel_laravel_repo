@extends('layout')

@section('content')
    <h1>Updating Post</h1>

    <form action="{{route('admin.post.update')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$post->id}}" name="id">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        </div>
        @if($errors->has('title'))
            @foreach($errors->get('title') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="body" class="form-label">Some info</label>
            <input type="text" class="form-control" id="body" name="body" value="{{$post->body}}">
        </div>
        @if($errors->has('body'))
            @foreach($errors->get('body') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option @if($category->id == $post->category->id) selected @endif value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('category_id'))
            @foreach($errors->get('category_id') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" id="user_id">
                @foreach($users as $user)
                    <option @if($user->id == $post->user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('user_id'))
            @foreach($errors->get('user_id') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <select name="tags[]" id="tags" multiple>
                @foreach($tags as $tag)
                    <option @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) selected @endif value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('tags'))
            @foreach($errors->get('tags') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
