<?php

namespace App\Imports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Transaction::firstOrCreate(
            [
                'vendor' => $row['description'],
                'amount' => $row['credit'] ?? $row['debit'],
            ],
            [
                'vendor' => $row['description'],
                'amount' => $row['credit'] ?? $row['debit'],
                'created_at' => Carbon::createFromFormat('d/m/Y', $row['date']),
            ]
        );
    }
}
