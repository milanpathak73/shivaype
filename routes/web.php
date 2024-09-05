<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SubAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\ClientAuthController;

// Admin Routes

Route::get('/', function () {
    return redirect()->route('login');  // This will redirect to the login page
});

Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClientAuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [ClientAuthController::class, 'logout'])->name('logout');

Route::middleware('auth:admin')->group(function() {
    Route::post('/admin/create-client', [AdminController::class, 'createClient'])->name('admin.create-client');
    Route::get('/admin/approve-transaction/{id}', [AdminController::class, 'approveTransaction'])->name('admin.approve-transaction');
});

// Client Routes
Route::middleware('auth:client')->group(function() {
    Route::get('/client/dashboard', [ClientController::class, 'showDashboard'])->name('client.dashboard');
    Route::get('/client/request-credit', [ClientController::class, 'showRequestCreditForm'])->name('client.request-credit');
    Route::post('/client/submit-credit-request', [ClientController::class, 'submitCreditRequest'])->name('client.submit-credit-request');
    Route::get('/client/create-sub-account', [ClientController::class, 'showCreateSubAccountForm'])->name('client.create-sub-account');
    Route::post('/client/submit-sub-account', [ClientController::class, 'submitSubAccount'])->name('client.submit-sub-account');
    Route::get('/client/request-status', [ClientController::class, 'showRequestStatus'])->name('client.request-status');
    Route::get('/client/manage-sub-accounts', [ClientController::class, 'showManageSubAccounts'])->name('client.manage-sub-accounts');
    Route::patch('/client/manage-sub-accounts/{id}', [ClientController::class, 'updateSubAccount'])->name('client.update-sub-account');
});


Route::get('/admin/create-client', [AdminController::class, 'showCreateClientForm'])->middleware('auth:admin')->name('admin.create.client.form');

// Handle creating a client
Route::post('/admin/create-client', [AdminController::class, 'createClient'])->middleware('auth:admin')->name('admin.create.client');

// List all clients
Route::get('/admin/clients', [AdminController::class, 'listClients'])->middleware('auth:admin')->name('admin.clients');

// Show client details and sub-accounts
Route::get('/admin/client/{clientId}', [AdminController::class, 'showClientDetails'])->middleware('auth:admin')->name('admin.client.details');

// List all transactions
Route::get('/admin/transactions', [AdminController::class, 'listTransactions'])->middleware('auth:admin')->name('admin.transactions');

// Approve transaction
Route::post('/admin/transaction/{transactionId}/approve', [TransactionController::class, 'approve'])->middleware('auth:admin')->name('admin.transaction.approve');

// Disapprove transaction
Route::post('/admin/transaction/{transactionId}/disapprove', [TransactionController::class, 'disapprove'])->middleware('auth:admin')->name('admin.transaction.disapprove');

// Sub-Account Routes
Route::middleware('auth:sub_account')->group(function() {
    Route::post('/sub-account/request-transaction', [SubAccountController::class, 'requestTransaction'])->name('sub_account.request-transaction');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin dashboard route
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->middleware('auth:admin')->name('admin.dashboard');

Route::get('/admin/client/{clientId}/subaccounts', [AdminController::class, 'showClientSubAccounts'])->middleware('auth:admin')->name('admin.client.subaccounts');

// Create client route
Route::post('/admin/create-client', [AdminController::class, 'createClient'])->middleware('auth:admin')->name('admin.create.client');

// Toggle sub-account status
Route::get('/admin/toggle-subaccount/{id}', [AdminController::class, 'toggleSubAccount'])->middleware('auth:admin')->name('admin.toggle.subaccount');

// Approve transaction
Route::get('/admin/approve-transaction/{id}', [AdminController::class, 'approveTransaction'])->middleware('auth:admin')->name('admin.approve.transaction');

// Disapprove transaction
Route::get('/admin/disapprove-transaction/{id}', [AdminController::class, 'disapproveTransaction'])->middleware('auth:admin')->name('admin.disapprove.transaction');


Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');

// Client dashboard route
Route::get('/client/dashboard', function() {
    return view('client.dashboard');
})->middleware('auth:client')->name('client.dashboard');

Route::post('/sub-account/create', [SubAccountController::class, 'createSubAccount'])->middleware('auth:client')->name('subaccount.create');
Route::post('/transaction/request', [SubAccountController::class, 'requestTransaction'])->middleware('auth:client')->name('transaction.request');
