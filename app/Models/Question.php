<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'question_text',
        'options',
        'correct_answer'
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
