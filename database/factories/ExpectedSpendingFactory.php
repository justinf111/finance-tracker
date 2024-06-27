<?php

namespace Database\Factories;

use App\Models\ExpectedSpending;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ExpectedSpendingFactory extends Factory
{
    protected $model = ExpectedSpending::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
