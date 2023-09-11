<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeGuide extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'desc', 'ingredients', 'instructions', 'tips', 'img'];

    protected $casts = [
        'ingredients' => 'json',
        'instructions' => 'json',
        'tips' => 'json',
    ];
    public function homebrewProduct()
    {
        return $this->belongsTo(HomebrewProduct::class);
    }

}