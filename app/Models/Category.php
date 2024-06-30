<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExpectedSpending;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'default_expected_spending'];
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function budgetCategory(): HasMany
    {
        return $this->hasMany(BudgetCategory::class);
    }
}
