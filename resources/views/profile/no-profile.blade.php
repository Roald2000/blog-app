@extends('layout')
@section('title', 'User has no profile setup')
@section('content')
    @if ($id == auth()->user()->id)
        <p>This seems to be your account. <a href="{{ route('profile.setup-profile') }}">Setup Profile</a></p>
    @else
        <h1>This user has not setup their profile yet.</h1>
    @endif
@endsection
