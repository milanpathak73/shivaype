@extends('client.dashboard')

@section('content')
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Request Credit</h2>

        <form action="{{ route('client.submit-credit-request') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="request_details" class="block text-gray-700 text-sm font-bold mb-2">Request Details</label>
                <input type="text" id="request_details" name="request_details"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                <input type="number" id="amount" name="amount" step="0.01"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="transaction_type" class="block text-gray-700 text-sm font-bold mb-2">Transaction Type</label>
                <select id="transaction_type" name="transaction_type"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="Cash">Cash</option>
                    <option value="USDT">USDT</option>
                    <option value="Bookie_entry">Bookie Entry</option>
                    <option value="Credit">Credit</option>
                </select>
            </div>

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create Request
            </button>
        </form>
    </div>
@endsection
