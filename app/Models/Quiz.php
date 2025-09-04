<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Quiz extends Model
{
    use SoftDeletes;

    protected $table = 'quizzes';

    protected $fillable = [
        'content_id',
        'created_by'
    ];

    // <-- tambahkan ini
    protected $casts = [
        'options' => 'array',
        'correct_answer' => 'integer', // opsional tapi recommended
    ];

    public function questions() {
        return $this->hasMany(Question::class, 'quiz_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
