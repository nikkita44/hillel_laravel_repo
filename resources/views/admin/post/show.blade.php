@extends('layout')

@section('content')
    <h1>Post</h1>
    <h2>{{ $post->title }}</h2>
    <h3>{{ $post->body }}</h3>
    <p>Category: {{ $post->category->title }}</p>
    <p>User: {{ $post->user->name }}</p>
    <p>Tags:
        @foreach($post->tags as $tag)
            {{$tag->title}},
        @endforeach
    </p>

    @can('update', $post)
        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}" class="btn btn-primary">Edit</a>
    @endcan
    <br>
    <div>
        <h4>Editorial changes</h4>
        <ul>
            @foreach($post->editorial_changes as $change)
                <li>{{ $change->body }}</li>
            @endforeach
        </ul>
    </div>

    <form action="{{ route('admin.post.add.comment', ['id' => $post->id]) }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="body" class="form-label">Write editorial change</label>
            <input type="text" class="form-control" id="body" name="body">
        </div>
        @if($errors->has('body'))
            @foreach($errors->get('body') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
