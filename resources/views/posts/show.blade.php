@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads/' . $post->imagen) }}" alt="imagen post">

            @auth
                <livewire:like-post :post="$post" />
            @endauth

            <div class="">
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>
                <p class="text-sm text-gray-500">

                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>

            @auth
                @if (auth()->user()->id == $post->user_id)
                    <div class="mt-5">
                        <form action="{{ route('posts.destroy', ['post' => $post, 'user' => $user]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Eliminar Publicación"
                                class="bg-red-500 hover:bg-red-600 transition-colors p-2 text-white rounded cursor-pointer mt-5 font-bold">
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5 mb-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un Nuevo Comentario
                    </p>

                    @if (session('mensaje'))
                        <p class="bg-green-500 text-white p-3 text-center rounded-lg mb-5 uppercase font-bold">
                            {{ session('mensaje') }}
                        </p>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label id="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Agrega un Comentario
                            </label>
                            <textarea name="comentario" id="comentario"
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                                placeholder="Agrega un Comentario">{{ old('comentario') }}</textarea>

                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth

                @guest
                    <p class="text-center text-xl font-bold">
                        Inicia Sesión para Comentar
                    </p>
                @endguest

                <div class="mt-5">
                    <p class="text-xl font-bold text-center mb-4">
                        Comentarios
                    </p>

                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="bg-gray-100 p-3 mb-3 rounded-lg">
                                <a class="font-bold"
                                    href="{{ route('posts.index', ['user' => $comentario->user->username]) }}">
                                    {{ $comentario->user->username }}
                                </a>
                                <p class="text-sm text-gray-500">
                                    {{ $comentario->created_at->diffForHumans() }}
                                </p>
                                <p class="mt-3">
                                    {{ $comentario->comentario }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-600 text-sm font-bold">
                            No hay comentarios aún.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
