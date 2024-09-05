<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .navbar {
            background-color: #4a4a4a;
        }
        .navbar a {
            color: #ffffff;
        }
        .navbar a:hover {
            background-color: #6b6b6b;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto p-6">
        <!-- Navbar -->
        <nav class="navbar rounded-lg shadow-md mb-6">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center">
                    <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                    <a href="{{ route('client.dashboard') }}" class="text-white text-xl font-bold ml-4">Dashboard</a>
                </div>
                <div class="hidden lg:flex flex-wrap items-center space-x-4">
                    <a href="{{ route('client.request-credit') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Request Credit</a>
                    <a href="{{ route('client.create-sub-account') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Create Sub-Account</a>
                    <a href="{{ route('client.request-status') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Request Status</a>
                    <a href="{{ route('client.manage-sub-accounts') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Manage Sub-Accounts</a>
                </div>
                <div class="hidden lg:block">
                    <form action="{{ route('logout') }}" method="GET" class="inline">
                        @csrf
                        <button type="submit" class="py-2 px-4 bg-red-500 hover:bg-red-700 text-white font-bold rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="menu" class="lg:hidden">
                <div class="bg-gray-800 text-white">
                    <a href="{{ route('client.request-credit') }}" class="block py-2 px-4 hover:bg-gray-600">Request Credit</a>
                    <a href="{{ route('client.create-sub-account') }}" class="block py-2 px-4 hover:bg-gray-600">Create Sub-Account</a>
                    <a href="{{ route('client.request-status') }}" class="block py-2 px-4 hover:bg-gray-600">Request Status</a>
                    <a href="{{ route('client.manage-sub-accounts') }}" class="block py-2 px-4 hover:bg-gray-600">Manage Sub-Accounts</a>
                    <form action="{{ route('logout') }}" method="POST" class="block py-2 px-4">
                        @csrf
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold rounded py-2">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-4xl font-bold mb-4">Welcome, {{ auth()->user()->username }}!</h1>
            <p class="text-xl mb-4">Current Balance: ${{ number_format(auth()->user()->balance, 2) }}</p>
        </div>

        @yield('content')
    </div>

    <!-- JavaScript for mobile menu toggle -->
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
