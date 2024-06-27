<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImportTransactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () { return Inertia::render('Dashboard');})->name('dashboard');
    Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::get('transactions/import', [ImportTransactionController::class, 'index'])->name('transactions.import.form');
    Route::post('transactions/import', [ImportTransactionController::class, 'import'])->name('transactions.import');
});
