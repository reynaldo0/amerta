<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes;

    protected $table = 'registrations';

    protected $fillable = [
        'status',
        'qr_code'
    ];

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
