<?php

namespace App\Imports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AmexTransactionsImport implements ToModel, WithHeadingRow
{
    public $account_id;

    public function  __construct($account_id)
    {
        $this->account_id = $account_id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $amount = -1 * floatval($row['amount']);

        return Transaction::firstOrCreate(
            [
                'vendor' => $row['description'],
                'amount' => $amount,
            ],
            [
                'vendor' => $row['description'],
                'amount' => $amount,
                'created_at' => Carbon::createFromFormat('d/m/Y', $row['date']),
                'account_id' => $this->account_id
            ]
        );
    }
}
