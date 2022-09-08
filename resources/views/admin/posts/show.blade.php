{{-- SINGLE POST DETAILS PAGE --}}

@extends('layouts.dashboard')

@section('content')

    <div class="card text-center">

        <div class="card-body">

          <h2 class="card-title"> {{$post->title}} </h2>

          <p class="card-text"> {{$post->content}} </p>  
          
          {{-- Category section --}}
          <div class="mb-4">
            Category: 
            
            @if ($post->category)

              <div class="btn btn-sm btn-outline-secondary">
                {{ $post->category->name }}
              </div>                

            @else
                <span>Not present</span>
            @endif
            
          </div>
                      
          {{-- Edit button --}}
          <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" 
            class="btn btn-primary">
            Edit
          </a>

          <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="post" class="d-inline">
            @csrf
            @method('DELETE')

            {{-- Delete button --}}
            <input 
              class="btn btn-danger"
              type="submit" 
              value="Delete" 
              onClick="return confirm('Are you sure?');"
            >
          </form>
        </div>

        <div class="card-footer text-muted">

          <div> Created: {{ $post->created_at->format('j F Y') }} </div>

          <div> Last update: {{ $post->created_at->format('j F Y') }} </div>

          <div> Slug: {{$post->slug}} </div>

        </div>
        
    </div>
@endsection