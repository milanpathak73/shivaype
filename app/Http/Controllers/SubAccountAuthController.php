<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubAccount;
use App\Models\Withdrawal;


class SubAccountAuthController extends Controller
{
     public function showLoginForm()
    {
        return view('subaccount-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        // dd($request->all());
        $credentials = $request->only('username', 'password');

        // $credentials['username'] = $credentials['email'];
        // unset($credentials['email']);
        // dd($credentials);
        if (Auth::guard('subaccount')->attempt($credentials)) {
            // Authentication passed
            // dd("dasdas");
            return redirect()->intended('subaccount/dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';  // This will use the 'username' column
    }
    public function dashboard()
    {
        $subAccount = Auth::user();
        $client = $subAccount->client; // Assuming there is a relationship with the Client model
        $balance = $subAccount->balance; // Assuming balance is a column in SubAccount model

        return view('subaccount.dashboard', compact('subAccount', 'client', 'balance'));
    }

    public function showRequests()
    {
        // Implement logic to show pending requests
        return view('subaccount.requests'); // Ensure this view file exists
    }

    public function showTransactions()
    {
        // Assuming you're fetching the sub-account ID of the logged-in user
        $subAccountId = auth()->user()->client_id;

        // Fetch transactions related to the sub-account
        $transactions = Withdrawal::where('sub_account_id', $subAccountId)->get();

        // Pass the transactions data to the view
        return view('subaccount.transactions', compact('transactions'));
    }


    public function showBalance()
    {
        // Implement logic to show balance
        return view('subaccount.balance'); // Ensure this view file exists
    }

    public function logout(Request $request)
    {
        Auth::guard('subaccount')->logout();

        return redirect('/subaccount/login'); // Redirect to the homepage or login page
    }
    public function transactions()
    {
        $transactions = Withdrawal::where('sub_account_id', Auth::id())->get();
        return view('subaccount.transactions', compact('transactions'));
    }

    // Withdrawal form page
    public function withdrawalForm()
    {
        $balance = Auth::user()->balance;
        return view('subaccount.withdrawal', compact('balance'));
    }

    // Submit withdrawal request
    public function submitWithdrawal(Request $request)
    {
        $request->validate([
            'account_number' => 'required',
            'account_holder_name' => 'required',
            'ifsc' => 'required',
            'amount' => 'required|numeric|max:' . Auth::user()->balance,
        ]);

        Withdrawal::create([
            'sub_account_id' => Auth::id(),
            'account_number' => $request->account_number,
            'account_holder_name' => $request->account_holder_name,
            'ifsc' => $request->ifsc,
            'amount' => $request->amount,
            'status' => 'Pending',
        ]);

        return redirect()->route('subaccount.withdrawal.history')->with('success', 'Withdrawal request submitted!');
    }

    // Withdrawal history page
    public function withdrawalHistory()
    {
        $withdrawals = Withdrawal::where('sub_account_id', Auth::id())->get();
        return view('subaccount.withdrawal-history', compact('withdrawals'));
    }
}
