<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col bg-gray-100">

        <!-- Navbar -->
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="{{ auth()->user()->hasRole('student') ? route('student.assignments.index') : route('admin.assignments.index') }}" class="text-xl font-bold text-blue-600">Submithub</a>

                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->hasRole('student'))
                            <a href="{{ route('student.assignments.index') }}" class="text-gray-700 hover:text-blue-600">My Assignments</a>
                            <a href="{{ route('student.assignments.create') }}" class="text-gray-700 hover:text-blue-600">Request Assignment</a>
                        @elseif(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.assignments.index') }}" class="text-gray-700 hover:text-blue-600">All Assignments</a>
                        @endif

                        <span class="text-gray-700">|</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-1 container mx-auto px-6 py-6">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-inner py-4 mt-auto">
            <div class="container mx-auto text-center text-gray-500">
                &copy; {{ date('Y') }} Submithub. All rights reserved.
            </div>
        </footer>
    </div>
    </body>
</html>
