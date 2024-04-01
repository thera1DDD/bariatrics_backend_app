<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['goal','current','kkal'. 'distance','achieved_at','users_id','date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
