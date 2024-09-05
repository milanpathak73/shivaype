<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // List all transactions
    public function listTransactions()
    {
        $transactions = Transaction::with('client', 'subAccount')->get();
        return view('admin.transactions', compact('transactions'));
    }

    // Approve a transaction
    public function approve($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->status = 'approved';
        $transaction->save();

        // Update the balance for the client
        $client = $transaction->client;
        $client->balance += $transaction->amount;
        $client->save();

        return redirect()->route('admin.transactions')->with('success', 'Transaction approved successfully.');
    }

    // Disapprove a transaction
    public function disapprove($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->status = 'disapproved';
        $transaction->save();

        return redirect()->route('admin.transactions')->with('success', 'Transaction disapproved successfully.');
    }
}
