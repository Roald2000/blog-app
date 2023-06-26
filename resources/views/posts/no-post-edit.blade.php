@extends('layout')

@section('title', 'Edit Failed')
@section('content')
    <section class="max-w-lg mx-auto mt-6 text-center">
        {{ $message }} <a class="hover:underline text-red-600" href='/'>Go Back</a>
    </section>
@endsection
