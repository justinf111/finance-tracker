<?php

namespace App\Imports;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

abstract class BaseTransactionsImport
{
    public $accountId;
    public $importedTransactions;

    public function  __construct($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
    * @param array $row
    *
    * @return Model|null
    */
    abstract public function model(array $row): ?Model;

    protected function createTransaction($amount, $vendor, $date) {
        $transaction = Transaction::firstOrCreate(
            [
                'vendor' => $vendor,
                'amount' => $amount,
            ],
            [
                'vendor' => $vendor,
                'amount' => $amount,
                'created_at' => Carbon::createFromFormat('d/m/Y', $date),
                'account_id' => $this->accountId
            ]
        );
        $this->importedTransactions[] = $transaction;
        return $transaction;
    }
}
