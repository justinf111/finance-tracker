<?php

namespace App\Imports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CommBankTransactionsImport implements ToModel
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
        return Transaction::firstOrCreate(
            [
                'vendor' => $row[2],
                'amount' => $row[1],
            ],
            [
                'vendor' => $row[2],
                'amount' => $row[1],
                'created_at' => Carbon::createFromFormat('d/m/Y', $row[0]),
                'account_id' => $this->account_id
            ]
        );
    }
}
