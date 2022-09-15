{{-- CREATE POST PAGE --}}

@extends('layouts.dashboard')

@section('content')

    <h2>Create a new post</h2>

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

    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- Title input --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        
        {{-- Content input --}}
        <div class="mb-3">
            <label for="content" class="form-label">Post content</label>
            <textarea class="form-control" id="content" name="content" rows="4"></textarea>
        </div>

        {{-- Category selection --}}
        <div class="mb-3">
            <label for="category_id"> Category: </label>
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
        
                <input 
                type="checkbox" 
                value="{{ $tag->id }}" 
                id="tag-{{$tag->id}}" 
                name="tags[]"
                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>

                <label class="mr-2" for="tag-{{$tag->id}}"> {{$tag->name}} </label>
                
            @endforeach
        </div>

        {{-- Image upload input --}}
        <div class="mb-3">
            <label for="cover" class="form-label"> Upload an image </label>

            <input class="form-control" type="file" name="cover" id="cover">
        </div>

        <div class="mb-3">
            <input type="submit" class="btn btn-success mb-3" value="Submit">
        </div>

    </form>

@endsection