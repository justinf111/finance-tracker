<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Categories/Index');
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'default_expected_spending' => 'required|numeric',
        ]);

        Category::query()->firstOrCreate(
            ['name' => $request->get('name')],
            $request->only(['name', 'default_expected_spending'])
        );

        return response()->noContent();
    }
}
