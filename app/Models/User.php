<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Content;
use App\Models\LibraryItem;
use App\Models\PageView;
use App\Models\Quiz;
use App\Models\UserQuiz;
use App\Models\Registration;
use App\Models\Comment;
use App\Models\Report;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    // use SoftDeletes; // Uncomment if users table uses soft deletes

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function contents() {
        return $this->hasMany(Content::class, 'author_id');
    }

    public function library_items() {
        return $this->hasMany(LibraryItem::class, 'uploaded_by');
    }

    public function page_views() {
        return $this->hasMany(PageView::class, 'user_id');
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class, 'created_by');
    }

    public function user_quizzes() {
        return $this->hasMany(UserQuiz::class, 'user_id');
    }

    public function registrations() {
        return $this->hasMany(Registration::class, 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function reports() {
        return $this->hasMany(Report::class, 'reporter_id');
    }
}
