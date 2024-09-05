@extends('client.dashboard')

@section('content')
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Manage Sub-Accounts</h2>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Username</th>
                    <th class="py-2 px-4 border-b text-left">Balance</th>
                    <th class="py-2 px-4 border-b text-left">Balance Increase</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subAccounts as $subAccount)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $subAccount->username }}</td>
                        <td class="py-2 px-4 border-b">{{ $subAccount->balance }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('client.update-sub-account', $subAccount->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="balance" value="{{ $subAccount->balance }}" step="0.01" class="mr-2">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                    Update Balance
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
