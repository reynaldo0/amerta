<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class LibraryItem extends Model
{
    use SoftDeletes;

    protected $table = 'library_items';

    protected $fillable = [
        'title',
        'description',
        'file',
        'file_url',
        'category',
        'metadata',
        'uploaded_by',
        'province_id',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function province() {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
