<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productable extends Model
{
    use HasFactory;

    public function productable()
    {
        return $this->morphTo();
    }
}