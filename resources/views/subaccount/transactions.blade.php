@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Transactions</h2>

        @if($transactions->isEmpty())
            <p>No transactions available.</p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Amount</th>
                        <th class="px-4 py-2 text-left">Type</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td class="border px-4 py-2">{{ $transaction->created_at->format('d/m/Y') }}</td>
                            <td class="border px-4 py-2">{{ $transaction->amount }}</td>
                            <td class="border px-4 py-2">{{ $transaction->type }}</td>
                            <td class="border px-4 py-2">{{ $transaction->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
