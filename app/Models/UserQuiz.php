<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserQuiz extends Model
{
    use SoftDeletes;

    protected $table = 'user_quizzes';

    protected $fillable = [
        'score',
        'completed_at',
        'certificate_url'
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
