@extends('admin.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mt-6">Client Details</h2>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h3 class="text-xl font-semibold">Client Information</h3>
        <p><strong>Username:</strong> {{ $client->username }}</p>
        <p><strong>Status:</strong> {{ $client->is_active ? 'Active' : 'Inactive' }}</p>

        <h3 class="text-xl font-semibold mt-4">Sub-Accounts</h3>
        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Username</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Balance</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($subAccounts as $subAccount)
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
@endsection
