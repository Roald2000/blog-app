@extends('layout')

@section('title', 'Register')
@section('content')
    <section class="max-w-lg border-2 shadow-md mt-6 mx-auto p-3 rounded">
        <h1 class="text-3xl font-bold">Register</h1>
        <hr class="my-3 border-red-600">
        <form class="w-full" action="{{ route('auth.create-user') }}" method="POST">
            @csrf
            <div class="w-full">
                <label for="name" class="flex flex-col gap-1">
                    <span>Name</span>
                    <input class="p-2 rounded border-2" type="name" name="name" id="name"
                        value="{{ old('name') }}" autofocus>
                </label>
                <label for="email" class="flex flex-col gap-1">
                    <span>Email</span>
                    <input class="p-2 rounded border-2" type="email" name="email" id="email"
                        value="{{ old('email') }}" autofocus>
                </label>
                <label for="password" class="flex flex-col gap-1">
                    <span>Password</span>
                    <input class="p-2 rounded border-2" type="password" name="password" id="password" autofocus>
                </label>
            </div>
            <br>
            <button class="p-2 rounded bg-blue-600 text-white">Register</button>
        </form>
    </section>
    <ul class="max-w-lg mx-auto mt-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li class="text-xs mt-3  rounded-md text-red-950 bg-red-200 p-2">
                    {{ $error }}
                </li>
            @endforeach
        @endif
        @if (session()->has('error'))
            <li class="text-xs mt-3  rounded-md text-red-950 bg-red-200 p-2">
                {{ session('error') }}
            </li>
        @endif
        @if (session()->has('success'))
            <li class="text-xs mt-3  rounded-md text-red-950 bg-red-200 p-2">
                {{ session('success') }}
            </li>
        @endif
    </ul>
@endsection
