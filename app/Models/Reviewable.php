<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewable extends Model
{
    use HasFactory;

    public function reviewable()
    {
        return $this->morphTo();
    }
}