<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BudgetCategoryController;
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
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');

    Route::get('/budget/search', [BudgetController::class, 'search'])->name('budget.search');
    Route::get('/budget/{budget}', [BudgetController::class, 'index'])->name('budget.index');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{budget}/{category}', [BudgetCategoryController::class, 'update'])->name('categories.update');

    Route::patch('transactions/{transaction}', [BudgetController::class, 'update'])->name('transactions.update');
    Route::get('transactions/import', [ImportTransactionController::class, 'index'])->name('transactions.import.form');
    Route::post('transactions/import', [ImportTransactionController::class, 'import'])->name('transactions.import');
});
