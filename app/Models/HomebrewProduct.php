<?php

namespace App\Models;

use App\Models\ProductCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomebrewProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'desc', 'homebrew_product_category_id', 'availability', 'img'];

    public function homebrewProductCategory()
    {
        return $this->belongsTo(HomebrewProductCategory::class);
    }

    public function brewingGuide()
    {
        return $this->hasMany(BrewingGuide::class);
    }

    public function recipeGuide()
    {
        return $this->hasMany(RecipeGuide::class);
    }

    public function productCarts()
    {
        return $this->morphToMany(ProductCart::class, 'productables');
    }

    public function order()
    {
        return $this->morphToMany(Order::class, 'itemables');
    }
}