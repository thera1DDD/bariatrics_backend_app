<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MealsFood extends Model
{
    use HasFactory;

    protected $fillable = ['foods_id','meals_id','quantity'];

    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class,'meals_id');
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class,'foods_id');
    }
}
