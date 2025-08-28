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
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
