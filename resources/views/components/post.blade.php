@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('user.posts', $post->user) }}" class="font-bold">{{ $post->user->username }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">
        {{ $post->body }}
    </p>
    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post->id)}}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>                                
            @else
                <form action="{{ route('posts.unlikes', $post->id)}}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Unike</button>
                </form>
            @endif

            @can('delete', $post)
                <form action="{{ route('posts.delete', $post->id)}}" method="post" class="mr-1">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="text-red-500">Delete</button>
                </form>  
                
            @endcan
        @endauth

        <span>{{ $post->likes->count() }} {{Str::plural('like', $post->likes->count())}}</span>
    </div>
</div>