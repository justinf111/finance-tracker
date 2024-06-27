<?php

namespace App\Http\Controllers;

use App\Imports\TransactionsImport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ImportTransactionController extends Controller
{
    public function index()
    {
        return Inertia::render('Import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'transactions' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new TransactionsImport, $request->file('transactions'));

        return redirect()->route('budget.index')->with('success', 'Transactions imported successfully.');
    }
}
