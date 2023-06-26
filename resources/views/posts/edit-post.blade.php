@extends('layout')
@section('title', 'Edit Post')
@section('content')
    <section class="max-w-lg mx-auto mt-6  ">
        <h1 class="text-3xl">Edit Post</h1>
        <form action="{{ route('post.edit-save', ['id' => $item->id]) }}" method="POST" class="w-full p-3">
            @csrf
            @method('PUT')
            <textarea placeholder="Write Something....." class="bg-blue-100 p-2 w-full rounded border resize-none" name="content"
                id="" cols="auto" rows="6">{{ $item->content }}</textarea>
            <button class="p-2 rounded bg-blue-600 text-white" type="submit">Save Edit</button>
        </form>
    </section>
@endsection
