<?php

namespace App\Models;

use App\Models\Beverage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeverageCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function beverage()
    {
        return $this->hasMany(Beverage::class);
    }
}