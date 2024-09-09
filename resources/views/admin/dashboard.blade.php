<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                    <a href="{{ route('admin.dashboard') }}" class="text-white text-xl font-bold ml-4">Admin Dashboard</a>
                </div>
                <div class="hidden lg:flex flex-wrap items-center space-x-4">
                    <a href="{{ route('admin.create.client.form') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Create Client</a>
                    <a href="{{ route('admin.clients') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Clients</a>
                    <a href="{{ route('admin.transactions') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Transactions</a>
                    <a href="{{ route('admin.withdrawal.history') }}" class="py-2 px-4 hover:bg-gray-700 rounded">Withdrawal History</a>
                </div>
                <div class="hidden lg:block">
                    <a href="{{ route('admin.logout') }}" class="py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                        Logout
                    </a>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="menu" class="lg:hidden">
                <div class="bg-gray-800 text-white">
                    <a href="{{ route('admin.create.client.form') }}" class="block py-2 px-4 hover:bg-gray-600">Create Client</a>
                    <a href="{{ route('admin.clients') }}" class="block py-2 px-4 hover:bg-gray-600">Clients</a>
                    <a href="{{ route('admin.transactions') }}" class="block py-2 px-4 hover:bg-gray-600">Transactions</a>
                    <a href="{{ route('admin.logout') }}" class="block py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                        Logout
                    </a>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
            <p>Welcome, <strong>{{ Auth::guard('admin')->user()->username }}</strong>.</p>
            @yield('content')
        </div>
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
