<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $table = 'medias';

    protected $fillable = [
        'file_url',
        'type'
    ];

    public function content() {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
