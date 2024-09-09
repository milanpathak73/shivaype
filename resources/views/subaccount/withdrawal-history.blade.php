@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Withdrawal History</h2>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Amount</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $withdrawal)
                    <tr>
                        <td class="px-4 py-2 border">{{ $withdrawal->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->amount }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->status }}</td>
                        <td class="px-4 py-2 border">
                            @if($withdrawal->image_path)
                                <a href="{{ asset('storage/' . $withdrawal->image_path) }}" target="_blank" class="text-blue-600">Download Image</a>
                            @else
                                No Image
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
