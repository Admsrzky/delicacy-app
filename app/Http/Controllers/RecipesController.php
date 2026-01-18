<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Recipe;

use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function allRecipes()
    {
        $categories = Category::all();
        $recipes = Recipe::latest()->paginate(12);

        return view('recipes.index', compact('recipes', 'categories'));
    }
}