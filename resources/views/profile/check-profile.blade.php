@extends('layout')

@section('title', 'Check Profile')
@section('content')
    <section class="max-w-lg mx-auto border shadow-md p-4 rounded mt-6 relative">
        @if (auth()->user()->id == $profile->user_id)
            <a class="absolute right-2 top-2 p-1 rounded bg-black text-white"
                href="{{ route('profile.setup-profile') }}">Edit</a>
        @endif
        <h1 class="text-center text-3xl font-bold">User's Profile</h1>
        <div class="flex justify-between items-center gap-3">
            <p class="font-semibold text-xl">{{ $profile->user->name }} | {{ $profile->user->id }}</p>
            <p class="font-semibold">{{ $profile->user->email }}</p>
        </div>
        <hr class="my-3 border-red-600">
        @if ($profile->account_status == 'Public')
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
        @else
            @if (auth()->user()->id == $profile->user_id)
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
            @else
                <div>
                    <p>This Users Account Status Is Private</p>
                </div>
            @endif
        @endif

    </section>
@endsection
