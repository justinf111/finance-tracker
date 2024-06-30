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

        BudgetCategory::where('budget_id', $budget->id)
            ->where('category_id', $category->id)
            ->update($request->only('expected_spending'));

        return redirect()->back();
    }
}
