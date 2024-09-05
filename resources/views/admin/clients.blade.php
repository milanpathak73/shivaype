@extends('admin.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mt-6">Clients List</h2>
    <table class="min-w-full bg-white border border-gray-300 mt-4">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Username</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Balance</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $client->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $client->username }}</td>
                    <td class="py-2 px-4 border-b">{{ $client->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="py-2 px-4 border-b">{{ $client->balance }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.client.details', $client->id) }}" class="text-blue-500 hover:text-blue-700">View sub accounts</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
