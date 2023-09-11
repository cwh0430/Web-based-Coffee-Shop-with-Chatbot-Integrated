<?php

namespace App\Http\Controllers;

use App\Models\BrewingGuide;
use App\Models\RecipeGuide;
use Illuminate\Http\Request;

class GuidingController extends Controller
{
    public function index()
    {
        $brews = BrewingGuide::all();
        $recipes = RecipeGuide::all();

        return view('guides.guiding', ['brews' => $brews, 'recipes' => $recipes]);
    }

    public function recipeShow($id)
    {
        $recipe = RecipeGuide::findOrFail($id);

        return view('guides.recipedetail', ['recipe' => $recipe]);
    }

    public function brewShow($id)
    {
        $brew = BrewingGuide::findOrFail($id);

        return view('guides.brewdetail', ['brew' => $brew]);
    }
}