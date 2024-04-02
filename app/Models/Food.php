<?php

namespace App\Models;

use Egulias\EmailValidator\Result\Reason\CRLFAtTheEnd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','kkal','gram','category_id'];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
