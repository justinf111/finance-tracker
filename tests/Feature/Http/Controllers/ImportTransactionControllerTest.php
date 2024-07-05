<?php

namespace Tests\Feature\Http\Controllers;

use App\Banks;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportTransactionControllerTest extends TestCase
{

    /** @test */
    public function calculates_the_correct_balance_after_importing_transactions()
    {
        $user = User::factory()->create();
        $account = Account::factory()->create(['name' => 'test', 'starting_balance' => 4000]);
        $file = new UploadedFile(base_path('tests/Data/Transactions.csv'),'transactions.csv', null, null, true);
        $response = $this->actingAs($user)->post(route('transactions.import'), [
            'account' => $account->id,
            'transactions' => $file,
            'bank' => Banks::ING->value,
        ])->assertOk();
    }
}
