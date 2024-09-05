@extends('client.dashboard')

@section('content')
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Request Status</h2>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Request Details</th>
                    <th class="py-2 px-4 border-b text-left">Amount</th>
                    <th class="py-2 px-4 border-b text-left">Transaction Type</th>
                    <th class="py-2 px-4 border-b text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $transaction->request_details }}</td>
                        <td class="py-2 px-4 border-b">${{ $transaction->amount }}</td>
                        <td class="py-2 px-4 border-b">{{ $transaction->transaction_type }}</td>
                        <td class="py-2 px-4 border-b">{{ ucfirst($transaction->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
