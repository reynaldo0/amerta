<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = "provinces";

    protected $fillable = [
        'name',
    ];

    public function items() {
        return $this->hasMany(LibraryItem::class, 'province_id');
    }

    public function region() {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
