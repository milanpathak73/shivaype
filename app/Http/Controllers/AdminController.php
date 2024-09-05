<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show dashboard with tabs for clients and transactions
    public function showDashboard()
    {
        $clients = Client::all(); // Fetch all clients
        $transactions = Transaction::all(); // Fetch all transactions
        return view('admin.dashboard', compact('clients', 'transactions'));
    }

    // Show sub-accounts for a specific client
    public function showClientSubAccounts($clientId)
    {
        $client = Client::findOrFail($clientId);
        $subAccounts = $client->subAccounts; // Fetch sub-accounts related to this client
        return view('admin.client-subaccounts', compact('client', 'subAccounts'));
    }

    // Show form for creating a client
    public function showCreateClientForm()
    {
        return view('admin.create-client');
    }

    // Handle creating a client
    public function createClient(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:clients',
            'password' => 'required|min:6',
        ]);

        Client::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Client created successfully.');
    }
    public function showClientDetails($clientId)
    {
        $client = Client::findOrFail($clientId);
        $subAccounts = $client->subAccounts;
        return view('admin.client-details', compact('client', 'subAccounts'));
    }

    public function listTransactions()
    {
        $transactions = Transaction::all();
        return view('admin.transactions', compact('transactions'));
    }
    public function listClients()
    {
        $clients = Client::all();
        return view('admin.clients', compact('clients'));
    }
}
