<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory;

    public function meal(): HasMany
    {
        return $this->hasMany(Meal::class,'day_id','id');
    }

    public function step(): HasMany
    {
        return $this->hasMany(Step::class,'day_id','id');
    }
}
