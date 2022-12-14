{{-- EDIT POST PAGE --}}

@extends('layouts.dashboard')

@section('content')

    <h2>Edit the post</h2>

    {{-- Validation error message --}}
    @if ($errors->any())
        <div class="validation-error mb-4">
            <ul class="list-group list-group-numbered">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item border-danger text-danger">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        {{-- Post title --}}
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

        {{-- Post content --}}
        <div class="mb-3">
            <label for="content" class="form-label">Post content</label>
            <textarea 
            class="form-control" 
            id="content" 
            name="content" 
            rows="4">{{ old('content', $post->content) }}</textarea>
        </div>

        {{-- Category select --}}
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">No category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tags selection --}}
        <div class="mb-3">
            <span>Tags:</span>
             @foreach ($tags as $tag)
                @if ($errors->any())
                    {{-- New values if there are validation errors --}}
                    <div class="form-check">
                        <input class="form-check-input" 
                        type="checkbox" 
                        value="{{ $tag->id }}" 
                        id="tag-{{ $tag->id }}" 
                        name="tags[]"
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{ $tag->name }}
                        </label>
                    </div>
                @else
                    {{-- Old values if there are not validation errors --}}
                    <div class="form-check">
                        <input class="form-check-input" 
                        type="checkbox" 
                        value="{{ $tag->id }}" 
                        id="tag-{{ $tag->id }}" 
                        name="tags[]"
                        {{ $post->tags->contains($tag) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endif

            @endforeach
        </div>

        {{-- Image upload input --}}
        <div class="mb-3">
            <label for="cover" class="form-label"> Upload an image </label>

            <input class="form-control" type="file" name="cover" id="cover">

            @if ($post->cover)
                <span>Current image</span>
                <img class="w-50 mt-4" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
            @endif
        </div>
        
        <div class="mb-3">
            <input type="submit" class="btn btn-success mb-3" value="Save">
        </div>

    </form>

@endsection