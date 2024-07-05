<?php

namespace App\Http\Controllers;

use App\Banks;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Accounts/Index', [
            'transactions' => Transaction::with(['account', 'category'])
                ->orderBy('created_at')
                ->get(),
            'categories' => Category::query()->get(),
            'accounts' => Account::query()->get(),
            'banks' => Banks::list()
        ]);
    }

    public function create()
    {
        return Inertia::render('Accounts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'starting_balance' => 'required|integer',
        ]);

        Account::query()->firstOrCreate(
            ['name' => $request->get('name')],
            $request->only(['name', 'starting_balance'])
        );

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }
}
