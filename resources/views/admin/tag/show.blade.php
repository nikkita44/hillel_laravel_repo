@extends('layout')

@section('content')
    <h1>Tag</h1>
    <h2>{{ $tag->title }}</h2>
    <h3>{{ $tag->slug }}</h3>

    @can('update', $tag)
        <a href="{{ route('admin.tag.edit', ['id' => $tag->id]) }}" class="btn btn-primary">Edit</a>
    @endcan
    <br>
    <div>
        <h4>Editorial changes</h4>
        <ul>
            @foreach($tag->editorial_changes as $change)
                <li>{{ $change->body }}</li>
            @endforeach
        </ul>
    </div>

    <form action="{{ route('admin.tag.add.comment', ['id' => $tag->id]) }}" method="post">
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
