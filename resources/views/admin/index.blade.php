{{-- ALL POSTS PAGE --}}

@extends('layouts.dashboard')

@section('content')

    <h2>Posts feed</h2>

    <div class="row">
        @foreach ($posts as $post)
        
            <div class="col-sm-4 mt-2">
                <div class="card">
                    
                    <div class="card-body">
                        <h3 class="card-title"> {{$post->title}} </h3>

                        <a href="{{route('admin.posts.show', ['post' => $post->id])}}" 
                            class="btn btn-primary">
                            Details
                        </a>
                    </div>

                </div>
            </div>

        @endforeach
    </div>

@endsection