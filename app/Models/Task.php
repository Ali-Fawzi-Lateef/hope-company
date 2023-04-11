<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function storage(): belongsTo
    {
        return $this->belongsTo(Storage::class);
    }
}
