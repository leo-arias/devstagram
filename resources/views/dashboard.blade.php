@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg') }}"
                    alt="imagen perfil" class="rounded-full">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-4">
                    <p class="text-gray-700 text-2xl">
                        {{ $user->username }}
                    </p>

                    @auth
                        @if (auth()->user()->id === $user->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @else
                            @if (!auth()->user()->isFollowing($user))
                                <form action="{{ route('users.follow', $user) }}" method="POST">
                                    @csrf
                                    <input type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 transition-colors cursor-pointer uppercase font-bold w-full px-3 py-1 text-xs text-white rounded-lg"
                                        value="Seguir">
                                    </input>
                                </form>
                            @else
                                <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit"
                                        class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold w-full px-3 py-1 text-xs text-white rounded-lg"
                                        value="Dejar de seguir">
                                    </input>
                                </form>
                            @endif
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers->count() }}
                    <span class="font-normal">
                        @Choice('Seguidor|Seguidores', $user->followers->count())
                    </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followings->count() }}
                    <span class="font-normal">
                        Siguiendo
                    </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $posts->count() }}
                    <span class="font-normal">
                        Posts
                    </span>
                </p>
            </div>
        </div>
    </div>

    <x-listar-post :posts="$posts" />
@endsection
