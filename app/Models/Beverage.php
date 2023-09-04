<?php

namespace App\Models;

use App\Models\BeverageCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beverage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'desc', 'beverage_category_id', 'availability', 'img'];

    public function beverageCategory()
    {
        return $this->belongsTo(BeverageCategory::class);
    }

    public function beverageCart()
    {
        return $this->belongsToMany(BeverageCart::class)->withPivot(['quantity', 'customization', 'id', 'sub_price']);
    }

    public function order()
    {
        return $this->morphToMany(Order::class, 'itemables');
    }
}