<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['goal','current','kkal', 'distance','achieved_at','users_id','date','day_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class,'day_id','id');
    }

}
