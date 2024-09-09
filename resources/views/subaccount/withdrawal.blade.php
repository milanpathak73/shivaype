@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-4">Withdrawal Request</h2>
    <form method="POST" action="{{ route('subaccount.withdrawal.submit') }}">
        @csrf
        <div class="mb-4">
            <label for="account_holder_name" class="block text-sm font-medium text-gray-700">Account holder name</label>
            <input id="account_holder_name" name="account_holder_name" type="text" required class="w-full mt-1 border border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="account_number" class="block text-sm font-medium text-gray-700">Account Number</label>
            <input id="account_number" name="account_number" type="text" required class="w-full mt-1 border border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="ifsc" class="block text-sm font-medium text-gray-700">IFSC Code</label>
            <input id="ifsc" name="ifsc" type="text" required class="w-full mt-1 border border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
            <input id="amount" name="amount" type="number" max="{{ $balance }}" required class="w-full mt-1 border border-gray-300 rounded-md">
            <p class="text-sm text-gray-500">Available balance: {{ $balance }}</p>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
@endsection
