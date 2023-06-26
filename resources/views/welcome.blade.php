@extends('layout')

@section('content')
    <section class="max-w-2xl p-2 mx-auto">
        <h1 class="text-3xl">Create Post</h1>

        <hr class="my-3 border-red-600">

        @auth
            @include('posts.create-post')
        @else
            <p><a class="p-1 rounded bg-blue-600 text-white" href="{{ route('auth.login') }}">Login</a> to create post</p>
        @endauth

        <hr class="my-3 border">

        <h1 class="text-3xl">Posts</h1>

        <hr class="my-3 border-red-600">

        <div class="flex flex-col gap-3 justify-stretch items-stretch">
            {{-- Loads All Usr Posts Here Sort By Latest --}}
            @include('posts.post-data')
        </div>
    </section>
@endsection
