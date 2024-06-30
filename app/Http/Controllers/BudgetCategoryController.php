<?php

namespace App\Http\Controllers;

use App\Models\BudgetCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetCategoryController extends Controller
{
    public function update(Request $request, BudgetCategory $budgetCategory)
    {
        $request->validate([
            'expected_spending' => 'required|numeric',
        ]);

        $budgetCategory->update($request->only('expected_spending'));

        return response()->noContent();
    }
}
