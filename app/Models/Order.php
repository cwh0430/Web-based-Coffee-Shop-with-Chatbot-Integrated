<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'total_price', 'session_id', 'created_by', 'type'];

    public function beverage()
    {
        return $this->morphedByMany(Beverage::class, 'itemables');
    }

    public function homebrewProduct()
    {
        return $this->morphedByMany(HomebrewProduct::class, 'itemables');
    }

    public function mechanic()
    {
        return $this->morphedByMany(Mechanic::class, 'itemables');
    }

    public function related()
    {
        return $this->hasMany(Itemable::class);
    }

}