<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulturalAsset extends Model
{
    use SoftDeletes;

    protected $table = 'cultural_assets';

    protected $fillable = [
        'name',
        'description',
        'category',
        'province',
        'latitude',
        'longitude',
        'metadata',
    ];
}
