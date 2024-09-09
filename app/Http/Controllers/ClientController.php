<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\SubAccount;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    public function showDashboard()
    {
        return view('client.dashboard');
    }

    public function showRequestCreditForm()
    {
        return view('client.request_credit');
    }

    public function submitCreditRequest(Request $request)
    {
        $request->validate([
            'request_details' => 'required|string',
            'amount' => 'required|numeric',
            'transaction_type' => 'required|string',
        ]);

        Transaction::create([
            'client_id' => Auth::id(),
            'sub_account_id' => null,
            'amount' => $request->amount,
            'status' => 'pending',
            'request_details' => $request->request_details,
            'transaction_type' => $request->transaction_type,
        ]);

        return redirect()->route('client.request-status')->with('success', 'Credit request submitted.');
    }

    public function showCreateSubAccountForm()
    {
        return view('client.create_sub_account');
    }

    public function submitSubAccount(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:sub_accounts',
            'password' => 'required|min:6',
        ]);

        SubAccount::create([
            'client_id' => Auth::id(),
            'username' => $request->username,
            'email' => $request->username,
            'password' => bcrypt($request->password),
            'balance' => 0,
            'is_active' => true,
        ]);

        return redirect()->route('client.manage-sub-accounts')->with('success', 'Sub-account created.');
    }

    public function showSubAccountWithdrawals()
{
    // Assuming you have a relationship set up
    $subAccounts = auth()->user()->subAccounts; // Get all sub-accounts of the client
    $withdrawals = [];

    foreach ($subAccounts as $subAccount) {
        $withdrawals = array_merge($withdrawals, $subAccount->withdrawals->toArray());
    }

    return view('client.subaccount.withdrawals', ['withdrawals' => $withdrawals]);
}

    public function showRequestStatus()
    {
        $transactions = Transaction::where('client_id', Auth::id())->get();
        return view('client.request_status', compact('transactions'));
    }

    public function showManageSubAccounts()
    {
        $subAccounts = SubAccount::where('client_id', Auth::id())->get();
        return view('client.manage_sub_accounts', compact('subAccounts'));
    }

    public function updateSubAccount(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'balance' => 'required|numeric|min:0',
        ]);

        // Find the sub-account and the client
        $subAccount = SubAccount::findOrFail($id);
        $client = Auth::user(); // Get the authenticated client

        // Check if the client has enough balance
        if ($client->balance < $request->balance) {
            return redirect()->route('client.manage-sub-accounts')
                             ->with('error', 'Insufficient balance to update the sub-account.');
        }

        // Deduct the balance from the client
        $client->balance -= $request->balance;
        $client->save();

        // Increase the balance in the sub-account
        $subAccount->balance += $request->balance;
        $subAccount->save();

        // Redirect with a success message
        return redirect()->route('client.manage-sub-accounts')
                         ->with('success', 'Sub-account balance updated successfully.');
    }
}
