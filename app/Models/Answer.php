<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'student_id',
        'question_id',
    ];

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
