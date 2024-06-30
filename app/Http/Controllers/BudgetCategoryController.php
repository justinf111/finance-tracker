<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetCategoryController extends Controller
{
    public function update(Request $request, Budget $budget, Category $category)
    {
        $request->validate([
            'expected_spending' => 'required|numeric',
        ]);

        $budgetCategory = BudgetCategory::updateOrCreate(
            [
                'budget_id' => $budget->id,
                'category_id' => $category->id
            ],
            [
                'expected_spending' => $request->get('expected_spending')
            ]
        );

        return redirect()->back();
    }
}
