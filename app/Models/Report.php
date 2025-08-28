<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $table = 'reports';

    protected $fillable = [
        'reason',
        'status'
    ];

    public function comment() {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function reporter(){
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
