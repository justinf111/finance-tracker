<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'month', 'year',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(BudgetCategory::class);
    }
}
