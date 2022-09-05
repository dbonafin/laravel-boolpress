{{-- LOGGED USER HOMEPAGE --}}

@extends('layouts.dashboard')

@section('content')

    <h1>Dashboard</h1>

    <h3>Welcome back, {{$user->name}}!</h3>
        
@endsection