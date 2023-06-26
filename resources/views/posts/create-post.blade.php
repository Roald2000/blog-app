<form action="{{ route('post.create') }}" method="POST" class="w-full p-3">
    @csrf
    @method('POST')
    <textarea placeholder="Write Something....." class="bg-blue-100 p-2 w-full rounded border resize-none" name="content"
        id="" cols="auto" rows="6"></textarea>
    <button class="p-2 rounded bg-blue-600 text-white" type="submit">Post</button>
</form>
