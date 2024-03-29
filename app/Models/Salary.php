<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id','base_salary'];
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
