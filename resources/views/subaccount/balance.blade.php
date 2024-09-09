@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-4">Sub-Account Dashboard</h2>
    <p><strong>Balance:</strong> {{ $balance }}</p>
    <p><strong>Account Details:</strong> {{ $subAccount->username }}</p>
    <p><strong>Client Account:</strong> {{ $client->name }}</p>
</div>
@endsection
