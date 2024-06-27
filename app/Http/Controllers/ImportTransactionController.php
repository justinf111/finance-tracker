<?php

namespace App\Http\Controllers;

use App\Imports\TransactionsImport;
use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ImportTransactionController extends Controller
{
    public function index()
    {
        return Inertia::render('Import', [
            'accounts' => Account::pluck('name', 'id'),
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'transactions' => 'required|mimes:xlsx,csv',
            'account' => 'required|exists:accounts,id',
        ]);

        Excel::import(new TransactionsImport($request->get('account')), $request->file('transactions'));

        return redirect()->route('budget.index')->with('success', 'Transactions imported successfully.');
    }
}
