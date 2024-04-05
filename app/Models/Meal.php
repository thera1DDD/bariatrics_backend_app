<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['type','meal_start_at','meal_end_at','users_id','ate_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
