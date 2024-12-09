<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <title>Devstagram -@yield('titulo')</title>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    @livewireStyles
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-2xl font-black" href="{{ route('home') }}">
                DevStagram
            </a>

            @auth
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('posts.create') }}"
                        class="flex items-center bg-white border gap-2 p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Post
                    </a>

                    <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', Auth::user()) }}">
                        Hola
                        <span class="font-normal">
                            {{ Auth::user()->username }}
                        </span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" value="Cerrar Sesión"
                            class="font-bold uppercase text-gray-600 text-sm cursor-pointer">
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Iniciar Sesión</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                </nav>
            @endguest

        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>

        @yield('contenido')
    </main>

    <footer class="mt-10 font-bold mx-auto p-5 text-center text-gray-500 uppercase">
        &copy; DevStagram - Todos los derechos reservados {{ now()->year }}.
    </footer>

    @livewireScripts
</body>

</html>
