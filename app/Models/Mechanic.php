<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'desc', 'mechanic_category_id', 'availability', 'img'];

    public function mechanicCategory()
    {
        return $this->belongsTo(MechanicCategory::class);
    }

    public function brewingGuide()
    {
        return $this->hasMany(BrewingGuide::class);
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