@extends('client.dashboard')

@section('content')
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Create Sub-Account</h2>

        <form action="{{ route('client.submit-sub-account') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="sub_account_username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" id="sub_account_username" name="username"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="sub_account_password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="sub_account_password" name="password"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create Sub-Account
            </button>
        </form>
    </div>
@endsection
