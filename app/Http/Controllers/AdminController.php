<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Withdrawal;

class AdminController extends Controller
{
    // Show dashboard with tabs for clients and transactions
    public function showDashboard()
    {
        $clients = Client::all(); // Fetch all clients
        $transactions = Transaction::all(); // Fetch all transactions
        return view('admin.dashboard', compact('clients', 'transactions'));
    }

    public function showWithdrawals()
{
    $withdrawals = Withdrawal::all();
    return view('admin.withdrawals', compact('withdrawals'));
}

// public function approveWithdrawal($id)
// {
//     $withdrawal = Withdrawal::find($id);
//     $withdrawal->status = 'Approved';
//     $withdrawal->save();

//     // Notify sub-account if necessary

//     return redirect()->route('admin.withdrawals')->with('success', 'Withdrawal approved.');
// }


public function approveWithdrawal($id)
{
    $withdrawal = Withdrawal::findOrFail($id);

    // Ensure the withdrawal is not already processed
    if ($withdrawal->status !== 'Pending') {
        return redirect()->route('admin.withdrawal.history')->with('error', 'Withdrawal request already processed.');
    }

    // Check if the sub-account has sufficient balance
    $subAccount = $withdrawal->subAccount;
    if ($subAccount->balance < $withdrawal->amount) {
        return redirect()->route('admin.withdrawal.history')->with('error', 'Insufficient balance.');
    }

    // Update the balance
    $subAccount->balance -= $withdrawal->amount;
    $subAccount->save();

    // Approve the withdrawal
    $withdrawal->status = 'Approved';
    $withdrawal->save();

    // Record the transaction
    Transaction::create([
        'sub_account_id' => $subAccount->id,
        'client_id' => $subAccount->client_id, // Make sure this field is populated
        'amount' => -$withdrawal->amount,
        'description' => 'Withdrawal approved',
    ]);

    return redirect()->route('admin.withdrawal.history')->with('success', 'Withdrawal approved and balance updated.');
}


public function rejectWithdrawal($id)
{
    $withdrawal = Withdrawal::findOrFail($id);
    $withdrawal->status = 'Rejected';
    $withdrawal->save();

    return redirect()->route('admin.withdrawal.history')->with('success', 'Withdrawal rejected.');
}

public function uploadImage(Request $request, $id)
{
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $withdrawal = Withdrawal::findOrFail($id);

    // Store the image
    $path = $request->file('image')->store('withdrawals', 'public');
    $withdrawal->image_path = $path;
    $withdrawal->save();

    return redirect()->route('admin.withdrawal.history')->with('success', 'Image uploaded successfully.');
}
public function showWithdrawalHistory()
{
    $withdrawals = Withdrawal::with('subAccount')->get();
    return view('admin.withdrawal-history', compact('withdrawals'));
}
// public function rejectWithdrawal($id)
// {
//     $withdrawal = Withdrawal::find($id);
//     $withdrawal->status = 'Rejected';
//     $withdrawal->save();

//     // Notify sub-account if necessary

//     return redirect()->route('admin.withdrawals')->with('success', 'Withdrawal rejected.');
// }

// public function uploadImage(Request $request, $id)
// {
//     $request->validate([
//         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     $withdrawal = Withdrawal::find($id);

//     if ($request->hasFile('image')) {
//         $imagePath = $request->file('image')->store('withdrawal_images', 'public');
//         $withdrawal->image_path = $imagePath;
//         $withdrawal->save();
//     }

//     return redirect()->route('admin.withdrawals')->with('success', 'Image uploaded.');
// }


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
    public function viewWithdrawals()
    {
        $withdrawals = Withdrawal::where('status', 'Pending')->get();
        return view('admin.withdrawals', compact('withdrawals'));
    }

    // Approve a withdrawal request
    // public function approveWithdrawal($id)
    // {
    //     $withdrawal = Withdrawal::find($id);
    //     $withdrawal->status = 'Approved';
    //     $withdrawal->save();

    //     // Update the sub-account balance
    //     $subAccount = $withdrawal->subAccount;
    //     $subAccount->balance -= $withdrawal->amount;
    //     $subAccount->save();

    //     return redirect()->back()->with('success', 'Withdrawal approved successfully!');
    // }

}
