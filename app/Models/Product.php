<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'type', 'image_path', 'order', 'visible'];

    protected $casts = [
        'visible' => 'boolean',
    ];
}