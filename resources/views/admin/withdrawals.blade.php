@extends('admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Withdrawal Requests</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Account Number</th>
                    <th class="px-4 py-2 border">IFSC</th>
                    <th class="px-4 py-2 border">Amount</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $withdrawal)
                    <tr>
                        <td class="px-4 py-2 border">{{ $withdrawal->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->account_number }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->ifsc }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->amount }}</td>
                        <td class="px-4 py-2 border">{{ $withdrawal->status }}</td>
                        <td class="px-4 py-2 border">
                            @if($withdrawal->image_path)
                                <a href="{{ asset('storage/' . $withdrawal->image_path) }}" target="_blank">View Image</a>
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            @if($withdrawal->status == 'Pending')
                                <form method="POST" action="{{ route('admin.approve', $withdrawal->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white py-1 px-2 rounded">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.reject', $withdrawal->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Reject</button>
                                </form>
                                <form method="POST" action="{{ route('admin.uploadImage', $withdrawal->id) }}" enctype="multipart/form-data" style="display:inline;">
                                    @csrf
                                    <input type="file" name="image" required>
                                    <button type="submit" class="bg-blue-500 text-white py-1 px-2 rounded">Upload Image</button>
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
