<?php

namespace App\Imports;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CommBankTransactionsImport extends BaseTransactionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row): ?Model
    {
        return $this->createTransaction($row[1], $row[2], $row[0]);
    }
}
