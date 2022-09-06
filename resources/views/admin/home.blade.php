{{-- LOGGED USER HOMEPAGE --}}

@extends('layouts.dashboard')

@section('content')

    <div class="card">

        <div class="card-header">
            <h2>Dashboard</h2>
        </div>

        <div class="card-body">

            <div>Welcome back, {{$user->name}}! </div>

            <p class="card-text">
                You are logged with the account: {{$user->email}}. 
            </p>
        </div>
      </div>
        
@endsection