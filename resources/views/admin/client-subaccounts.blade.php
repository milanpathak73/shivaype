<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Sub Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-4">Sub Accounts for {{ $client->username }}</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:text-blue-700">Back to Dashboard</a>

        <!-- Sub Accounts Table -->
        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Sub Account ID</th>
                    <th class="py-2 px-4 border-b">Username</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subAccounts as $subAccount)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $subAccount->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $subAccount->username }}</td>
                    <td class="py-2 px-4 border-b">{{ $subAccount->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="py-2 px-4 border-b">{{ $subAccount->balance }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
