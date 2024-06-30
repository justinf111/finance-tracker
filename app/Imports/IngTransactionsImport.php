<?php

namespace App\Imports;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IngTransactionsImport extends BaseTransactionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row): ?Model
    {
        $amount = $row['credit'] ?? $row['debit'];
        return $this->createTransaction($amount, $row['description'], $row['date']);
    }
}
