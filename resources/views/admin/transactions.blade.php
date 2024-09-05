@extends('admin.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mt-6">Transactions</h2>

    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Client Username</th>
                {{-- <th class="py-2 px-4 border-b">Sub-Account Username</th> --}}
                <th class="py-2 px-4 border-b">Amount</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $transaction->client->username }}</td>
                    {{-- <td class="py-2 px-4 border-b">{{ $transaction->subAccount->username }}</td> --}}
                    <td class="py-2 px-4 border-b">{{ $transaction->amount }}</td>
                    <td class="py-2 px-4 border-b">{{ $transaction->status }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($transaction->status == 'pending')
                            <form action="{{ route('admin.transaction.approve', $transaction->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-500 hover:text-green-700">Approve</button>
                            </form>
                            <form action="{{ route('admin.transaction.disapprove', $transaction->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">Disapprove</button>
                            </form>
                        @else
                            {{ ucfirst($transaction->status) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
