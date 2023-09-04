<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeverageCart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beverage()
    {
        return $this->belongsToMany(Beverage::class)->withPivot(['quantity', 'customization', 'id', 'sub_price']);
    }
}