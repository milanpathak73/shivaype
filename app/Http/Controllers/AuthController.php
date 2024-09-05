<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\SubAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showDashboard()
    {
        $subAccounts = SubAccount::all();
        $transactions = Transaction::all();
        return view('admin.dashboard', compact('subAccounts', 'transactions'));
    }

    public function createClient(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'email', 'unique:clients'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        Client::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Client created successfully!');
    }

    public function toggleSubAccount($id)
    {
        $subAccount = SubAccount::findOrFail($id);
        $subAccount->is_active = !$subAccount->is_active;
        $subAccount->save();

        return redirect()->route('admin.dashboard')->with('success', 'Sub account status updated.');
    }

    public function approveTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'approved';
        $transaction->save();

        // Update client balance here if needed

        return redirect()->route('admin.dashboard')->with('success', 'Transaction approved.');
    }

    public function disapproveTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'disapproved';
        $transaction->save();

        // Handle disapproval logic here if needed

        return redirect()->route('admin.dashboard')->with('success', 'Transaction disapproved.');
    }
}
