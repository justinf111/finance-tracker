<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Accounts/Index');
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
