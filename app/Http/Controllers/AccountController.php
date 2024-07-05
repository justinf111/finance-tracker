<?php

namespace App\Http\Controllers;

use App\Banks;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'balance' => 'required|numeric',
            'bank' => ['required', Rule::enum(Banks::class)]
        ]);

        Account::query()->create(
            $request->only(['name', 'balance', 'bank'])
        );

        return redirect()->back()->with('success', 'Account created successfully.');
    }
}
