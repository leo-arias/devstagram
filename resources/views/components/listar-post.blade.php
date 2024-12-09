<section class=" mx-auto mt-10">
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="">
                    <a href="{{ route('posts.show', ['post' => $post->id, 'user' => $post->user->username]) }}">
                        <img src="{{ asset('uploads/' . $post->imagen) }}" alt="imagen post">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-gray-600 text-sm text-center font-bold uppercase">
            No hay publicaciones, sigue a otros usuarios para ver sus publicaciones.
        </p>
    @endif
</section>
