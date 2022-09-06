@extends('layouts.dashboard')

@section('content')

    <div class="card text-center">

        <div class="card-body">
          <h2 class="card-title"> {{$post->title}} </h2>

          <p class="card-text"> {{$post->content}} </p>

          <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" 
            class="btn btn-primary">
            Edit
          </a>
          <a href="#" class="btn btn-danger">Delete</a>
        </div>

        <div class="card-footer text-muted">

          <div> Created: {{$post->created_at}} </div>

          <div> Last update: {{$post->created_at}} </div>

          <div> Slug: {{$post->slug}} </div>
        </div>
        
    </div>
@endsection