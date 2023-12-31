<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrewingGuide extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'using_tools', 'instructions', 'tips', 'img'];

    protected $casts = [
        'using_tools' => 'json',
        'instructions' => 'json',
        'tips' => 'json',
    ];

    public function homebrewProduct()
    {
        return $this->belongsTo(HomebrewProduct::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}