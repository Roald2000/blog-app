@foreach ($posts as $item)
    <div class="flex-grow flex-shrink-0 basis-full shadow-lg border border-red-700 p-4 rounded">
        <div class="flex flex-row items-center justify-between">
            <p class="text-xs">Created {{ $item->created_at->diffForHumans() }} </p>
            <p class="text-xs">Updated {{ $item->updated_at->diffForHumans() }} </p>
        </div>
        <br>
        <div class="text-xs font-semibold flex flex-row gap-3 flex-wrap justify-between">
            <a title="{{ $item->user->email }}"
                class="w-[150px] whitespace-nowrap overflow-hidden text-ellipsis p-1 rounded bg-red-600 text-white"
                href="{{ route('profile.check-profile', ['id' => $item->user->id]) }}">
                {{ $item->user->name }} |
                {{ $item->user->email }}
            </a>
            @auth
                @if ($item->user_id == auth()->user()->id)
                    <div>
                        <a href="{{ route('post.edit', ['id' => $item->id]) }}">Edit</a>
                        <a href="{{ route('post.delete', ['id' => $item->id]) }}">Delete</a>
                    </div>
                @endif
            @endauth
        </div>
        <hr class="my-2 border border-red-700">
        <div class="p-2 rounded border-2">
            {{ $item->content }}
        </div>
        <hr class="my-2 border border-red-700">
        <div>
            @auth
                <form action="{{ route('post.post-comment') }}" method="POST"
                    class="flex justify-stretch items-center gap-2">
                    @csrf
                    @method('POST')
                    <input placeholder="Comment" class="flex-auto p-1 rounded border bg-slate-200" type="text"
                        name="comment" id="">
                    <input type="text" value="{{ $item->id }}" name="post_id" id="" hidden>
                    <button type="submit">✒</button>
                </form>
            @else
                <a href="{{ route('auth.login') }}">Login to comment.</a>
            @endauth
        </div>
        {{-- Add Comment Hide/Show Here --}}
        <div>
            <hr class="my-3 border-red-300">
            <button onclick="toggleComments({{ $item->id }})">Comments</button>
            <ul class="text-xs border px-1 py-3 rounded overflow-y-scroll overflow-clip h-[150px]"
                id="comments_{{ $item->id }}" style="display: none;">
                @if (count($item->comments) == 0)
                    <li>No Comments</li>
                @else
                    @foreach ($item->comments as $comment_data)
                        <li class="flex flex-col">
                            <span class="font-bold flex flex-row justify-between items-center">
                                <div>
                                    <a href="{{ route('profile.check-profile', ['id' => $comment_data->user->id]) }}">
                                        {{ $comment_data->user->name }}
                                    </a>
                                </div>
                                <div>
                                    @auth
                                        @if ($item->user_id == $comment_data->user->id)
                                            <span class="bg-blue-300 text-blue-900 p-1 rounded">Author</span>
                                            <a
                                                href="{{ route('post.delete-comment', ['id' => $comment_data->id]) }}">Delete</a>
                                        @endif
                                    @endauth
                                </div>
                            </span>
                            <span class="indent-3 ">{{ $comment_data->comment }}</span>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endforeach

@push('scripts')
    <script>
        function toggleComments(postId) {
            var commentsDiv = document.getElementById('comments_' + postId);
            if (commentsDiv.style.display === 'none') {
                commentsDiv.style.display = 'block';
            } else {
                commentsDiv.style.display = 'none';
            }
        }
    </script>
@endpush
