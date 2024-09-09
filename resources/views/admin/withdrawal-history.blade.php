@extends('admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Withdrawal History</h2>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Sub-Account</th>
                    <th class="px-4 py-2 border">account holder name</th>
                    <th class="px-4 py-2 border">account number</th>
                    <th class="px-4 py-2 border">ifsc</th>
                    <th class="px-4 py-2 border">amount</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $withdrawal)
                    <tr>
                        <td class="px-4 py-2 border">{{ $withdrawal->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->subAccount->username }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->account_holder_name }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->account_number }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->ifsc }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->amount }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->status }}</td>
                        <td class="px-4 py-2 border">
                            @if($withdrawal->image_path)
                                <a href="{{ asset('storage/' . $withdrawal->image_path) }}" target="_blank" class="text-blue-600">View Image</a>
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            <form method="POST" action="{{ route('admin.approve', $withdrawal->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="py-1 px-3 bg-green-500 hover:bg-green-700 text-white font-bold rounded">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.reject', $withdrawal->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="py-1 px-3 bg-red-500 hover:bg-red-700 text-white font-bold rounded">Reject</button>
                            </form>
                            @if(!$withdrawal->image_path)
                                <form method="POST" action="{{ route('admin.uploadImage', $withdrawal->id) }}" enctype="multipart/form-data" class="mt-2">
                                    @csrf
                                    <input type="file" name="image" class="border border-gray-300 rounded-md shadow-sm">
                                    <button type="submit" class="py-1 px-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Upload Image</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
