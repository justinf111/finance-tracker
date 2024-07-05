<?php

namespace App\Actions;

use App\Models\Account;

class UpdateAccountBalanceFromTransactions
{
    public function run(Account $account, array $transactions)
    {
        $account->starting_balance = $account->starting_balance + collect($transactions)->sum('amount');
        $account->save();
    }
}
