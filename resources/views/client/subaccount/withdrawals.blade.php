@extends('client.dashboard')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h1 class="text-2xl font-bold mb-4">Sub-Account Withdrawals</h1>
    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Sub-Account Id</th>
                <th class="py-2 px-4 border-b">Account Holder Name</th>
                <th class="py-2 px-4 border-b">Bank Account Number</th>
                <th class="py-2 px-4 border-b">Amount</th>
                <th class="py-2 px-4 border-b">Date</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Image</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($withdrawals as $withdrawal)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $withdrawal['sub_account_id'] }}</td>
                    <td class="py-2 px-4 border-b">{{ $withdrawal['account_holder_name'] }}</td>
                    <td class="py-2 px-4 border-b">{{ $withdrawal['account_number'] }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($withdrawal['amount'], 2) }}</td>
                    <td class="py-2 px-4 border-b">{{ $withdrawal['created_at'] }}</td>
                    <td class="py-2 px-4 border-b">{{ $withdrawal['status'] }}</td>
                    <td class="py-2 px-4 border-b">
                        @if ($withdrawal['image_path'])
                            <a href="{{ asset('storage/' . $withdrawal['image_path']) }}" class="text-blue-500" target="_blank">View Image</a>
                        @else
                            No Image
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-2 px-4 border-b text-center">No withdrawals found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
