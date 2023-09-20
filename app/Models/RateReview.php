<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateReview extends Model
{
    use HasFactory;

    protected $table = 'rate_reviews';
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        return $this->hasMany(Reviewable::class);
    }
}