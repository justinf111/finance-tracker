<?php

namespace App\Http\Controllers;

use App\Actions\CreateBudgetFromTransactions;
use App\Actions\UpdateAccountBalanceFromTransactions;
use App\Banks;
use App\Imports\AmexTransactionsImport;
use App\Imports\CommBankTransactionsImport;
use App\Imports\IngTransactionsImport;
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
            'banks' => Banks::list()
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'transactions' => 'required|mimes:xlsx,csv',
            'account' => 'required|exists:accounts,id',
        ]);

        $account = Account::find($request->get('account'));

        $importTypes = [
            Banks::CommBank->value => CommBankTransactionsImport::class,
            Banks::Amex->value => AmexTransactionsImport::class,
            Banks::ING->value => IngTransactionsImport::class,
        ];

        $import = new $importTypes[Banks::from($account->bank)->value]($request->get('account'));
        Excel::import($import, $request->file('transactions'));

        if ($import->importedTransactions) {
            resolve(CreateBudgetFromTransactions::class)->run($import->importedTransactions);
            resolve(UpdateAccountBalanceFromTransactions::class)->run($account, $import->importedTransactions);
        }

        return redirect()->back();
    }
}
