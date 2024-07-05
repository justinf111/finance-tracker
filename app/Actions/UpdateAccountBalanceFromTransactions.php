<?php

namespace App\Actions;

use App\Models\Account;

class UpdateAccountBalanceFromTransactions
{
    public function run(Account $account, array $transactions)
    {
        $account->balance = $account->balance + collect($transactions)->sum('amount');
        $account->save();
    }
}
