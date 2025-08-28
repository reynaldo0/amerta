<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'date',
        'location',
        'type'
    ];

    public function registrations() {
        return $this->hasMany(Registration::class, 'event_id');
    }

    public function content() {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
