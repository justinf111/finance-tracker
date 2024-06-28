<?php

namespace App\Http\Controllers;

use App\Banks;
use App\Imports\AmexTransactionsImport;
use App\Imports\CommBankTransactionsImport;
use App\Imports\IngTransactionsImport;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ImportTransactionController extends Controller
{
    public function index()
    {
        return Inertia::render('Import', [
            'accounts' => Account::pluck('name', 'id'),
            'banks' => Banks::list()
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'transactions' => 'required|mimes:xlsx,csv',
            'account' => 'required|exists:accounts,id',
            'bank' => ['required', Rule::enum(Banks::class)]
        ]);

        $importTypes = [
            Banks::CommBank->value => CommBankTransactionsImport::class,
            Banks::Amex->value => AmexTransactionsImport::class,
            Banks::ING->value => IngTransactionsImport::class,
        ];

        Excel::import(new $importTypes[$request->get('bank')]($request->get('account')), $request->file('transactions'));

        return redirect()->route('budget.index')->with('success', 'Transactions imported successfully.');
    }
}
