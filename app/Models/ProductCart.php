<?php

namespace App\Models;

use App\Models\Mechanic;
use App\Models\HomebrewProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCart extends Model
{
    use HasFactory;

    protected $table = "product_carts";


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homebrewProduct()
    {
        return $this->morphedByMany(HomebrewProduct::class, 'productables');
    }

    public function mechanic()
    {
        return $this->morphedByMany(Mechanic::class, 'productables');
    }

    public function related()
    {
        return $this->hasMany(Productable::class);
    }
}