@extends('layout')

@section('title', 'Setup Profile')
@section('content')
    <section class="max-w-lg mx-auto border shadow-md p-4 rounded mt-6 relative">
        <h1 class="text-center text-3xl font-bold">Setup Profile for {{ auth()->user()->email }}</h1>
        <hr class="my-3 border-red-600">
        <form action="{{ route('profile.create-update') }}" class="w-full" method="POST">
            @csrf
            @method('POST')
            <div class="flex flex-col gap-3">
                <label for="" class="w-full">
                    <span>Name</span>
                    <input value="{{ !$profile ? '' : $profile->address }}"
                        class="w-full p-2 rounded border-2 appearance-none" type="text" name="name" id="">
                </label>
                <label for="" class="w-full">
                    <span>Gender</span>
                    <input value="{{ !$profile ? '' : $profile->gender }}" list="gender_list"
                        class="w-full p-2 rounded border-2 appearance-none" type="text" name="gender" id="">
                    <datalist id="gender_list">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Specify...</option>
                    </datalist>
                </label>
                <label for="" class="w-full">
                    <span>Age</span>
                    <input value="{{ !$profile ? '' : $profile->age }}" class="w-full p-2 rounded border-2 appearance-none"
                        type="number" name="age" id="">
                </label>
                <label for="" class="w-full">
                    <span>Contact</span>
                    <input value="{{ !$profile ? '' : $profile->contact }}" class="w-full p-2 rounded border-2"
                        type="text" name="contact" id="">
                </label>
                <label for="" class="w-full">
                    <span>Address</span>
                    <input value="{{ !$profile ? '' : $profile->address }}" class="w-full p-2 rounded border-2"
                        type="text" name="address" id="">
                </label>
                <div>
                    <p>Account Status</p>
                    <div class="px-4 flex justify-start items-center gap-1">
                        <input {{ (!$profile ? '' : $profile->account_status == 'Public') ? 'checked' : '' }}
                            class=" p-2 rounded border-2" type="radio" value="Public" name="account_status"
                            id="public">
                        <label class="text-xs font-bold" for="public">Public</label>
                        <input {{ (!$profile ? '' : $profile->account_status == 'Private') ? 'checked' : '' }}
                            class="  p-2 rounded border-2" type="radio" value="Private" name="account_status"
                            id="private">
                        <label class="text-xs font-bold" for="private">Private</label>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="p-2 bg-blue-600 text-white rounded-md">Save</button>
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
