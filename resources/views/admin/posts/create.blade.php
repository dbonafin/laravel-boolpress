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

    <form action="{{route('admin.posts.store')}}" method="post">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Post content</label>
            <textarea class="form-control" id="content" name="content" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success mb-3" value="Submit">
        </div>

    </form>

@endsection