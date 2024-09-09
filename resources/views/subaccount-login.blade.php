@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Branch Account Login')</title>

    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Optional: Include custom configuration -->
    {{-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo: '#5c6ac4',
                        teal: '#4fd1c5',
                        rose: '#f43f5e',
                    }
                }
            }
        }
    </script> --}}
</head>

<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Branch Account Login</h2>
        <form method="POST" action="{{ route('subaccount.login') }}">
            @csrf

            <!-- username Address -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">username</label>
                <input id="username" name="username" value="{{ old('username') }}" required autofocus
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('username')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Login
                </button>
            </div>
        </form>

        <!-- Additional Info -->
        <div class="text-center mt-6">
            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">Forgot your password?</a>
        </div>
    </div>
</div>
@endsection
