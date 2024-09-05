<?php

namespace App\Http\Controllers;

use App\Models\SubAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SubAccountController extends Controller
{
    // Create a sub-account
    public function createSubAccount(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|unique:sub_accounts',
            'password' => 'required|min:6',
        ]);

        // Create a new sub-account
        SubAccount::create([
            'client_id' => Auth::id(), // Using the authenticated client's ID
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Sub-account created successfully.');
    }

    // Request a transaction
    public function requestTransaction(Request $request)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Create a new transaction request
        Transaction::create([
            'client_id' => Auth::id(), // Using the authenticated client's ID
            'sub_account_id' => $request->sub_account_id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Transaction request submitted.');
    }
}
