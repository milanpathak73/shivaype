@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
    <p><strong>Balance:</strong> {{ $balance }}</p>
    <p><strong>Account Details:</strong> {{ $subAccount->name }} ({{ $subAccount->username }})</p>
    <p><strong>Client Account:</strong> {{ $client->username }}</p>
</div>
@endsection
