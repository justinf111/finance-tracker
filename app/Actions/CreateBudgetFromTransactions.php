<?php

namespace App\Actions;

use App\Models\Budget;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CreateBudgetFromTransactions
{
    public function run(array $transactions)
    {
        collect($transactions)->groupBy(function(Transaction $transaction) {
            return $transaction->created_at->month.'/'.$transaction->created_at->year;
        })
            ->keys()
            ->each(function($month) {
                $date = Carbon::createFromFormat('m/Y', $month);
                Budget::firstOrCreate(
                    ['month' => $date->month, 'year' => $date->year],
                    ['month' => $date->month, 'year' => $date->year]
                );
            });
    }
}
