<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeGuide extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'ingredient', 'instructions', 'tips', 'homebrew_product_id', 'img'];

    public function homebrewProduct()
    {
        return $this->belongsTo(HomebrewProduct::class);
    }

}