<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BudgetController extends Controller
{
    public function index(Budget $budget)
    {
        $categories = Category::with(['transactions' => function($query) use ($budget) {
            $query->with(['account'])
                ->whereYear('created_at', $budget->year)
                ->whereMonth('created_at', $budget->month);
        }, 'budgetCategory' => function($query) use ($budget) {
            $query->where('budget_id', $budget->id);
        }])
            ->get()
            ->map(function ($category) {
                $category->total = $category->transactions->sum('amount');
                $category->available = ($category->budgetCategory->first()->expected_spending ?? $category->default_expected_spending) + $category->total;
                return $category;
            });

        return Inertia::render('Budget', [
            'categories' => $categories,
        ]);
    }

    // Update transaction
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:255',
        ]);

        $transaction->update($request->only('category_id', 'description'));

        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }
}
