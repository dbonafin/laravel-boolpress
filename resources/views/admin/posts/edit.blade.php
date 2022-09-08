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
        
        <div class="mb-3">
            <input type="submit" class="btn btn-success mb-3" value="Save">
        </div>

    </form>

@endsection