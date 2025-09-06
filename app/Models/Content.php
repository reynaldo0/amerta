<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Content extends Model
{
    use SoftDeletes;

    protected $table = 'contents';

    protected $fillable = [
        'title',
        'body',
        'type',
        'slug',
        'author_id',
        'status',
        'updated_at'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function medias() {
        return $this->hasMany(Media::class, 'content_id');
    }
    
    public function quiz() {
        return $this->hasMany(Quiz::class, 'content_id');
    }
}
