@extends('layouts.dashboard')

@section('content')

    <h2>Edit the post</h2>

    {{-- Validation error message --}}
    @if ($errors->any())
        <div class="validation-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input 
                type="text" 
                class="form-control" 
                id="title" 
                name="title" 
                value="{{ old('title', $post->title) }}"
            >
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Post content</label>
            <textarea 
            class="form-control" 
            id="content" 
            name="content" 
            rows="4">{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success mb-3" value="Save changes">
        </div>

    </form>

@endsection