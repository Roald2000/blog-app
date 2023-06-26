@extends('layout')

@section('title', 'Profile')
@section('content')
    <section class="max-w-lg mx-auto border shadow-md p-4 rounded mt-6 relative">
        <a class="absolute right-2 top-2 p-1 rounded bg-black text-white" href="{{ route('profile.setup-profile') }}">Edit</a>
        <h1 class="text-center text-3xl font-bold">Profile</h1>
        <div class="flex justify-between items-center gap-3">
            <p class="font-semibold text-xl">
                {{ $profile->user->name }}
            </p>
            <p class="font-semibold">
                {{ $profile->user->email }}
            </p>
        </div>
        <hr class="my-3 border-red-600">
        <div class=" flex flex-wrap gap-4">
            <label for="">
                <span>Gender</span>
                <p class="font-semibold">{{ $profile->gender }}</p>
            </label>
            <label for="">
                <span>Age</span>
                <p class="font-semibold">{{ $profile->age }}</p>
            </label>
        </div>
        <hr class="my-3 border-red-600">
        <div>
            <label for="">
                <span>Contact</span>
                <p class="font-semibold">{{ $profile->contact }}</p>
            </label>
            <label for="">
                <span>Address</span>
                <p class="font-semibold">{{ $profile->address }}</p>
            </label>
        </div>
        <hr class="my-3 border-red-600">
        <div>
            <label for="">
                <span>Status</span>
                <p class="font-semibold">{{ $profile->account_status }}</p>
            </label>
        </div>
    </section>
@endsection
