<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BudgetController extends Controller
{
    public function index()
    {
        dd(Transaction::query()->with('account')->whereBetween('created_at', [now()->firstOfMonth(), now()->lastOfMonth()])->get());
        return Inertia::render('Budget', [
            'transactions' => Transaction::query()->with('account')->whereBetween('created_at', [now()->firstOfMonth(), now()->lastOfMonth()])->get(),
            'categories' => Category::query()->get(),
        ]);
    }
}
