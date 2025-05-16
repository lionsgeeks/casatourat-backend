<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'circuit',
        'evaluation',
        'appreciation',
        'difficulty',
        'suggestion',
        'interested',
        'source',
        'contact',
        'language',
    ];

    protected $casts = [
        'source' => 'array',
        'contact' => 'array',
        'appreciation' => 'array',
    ];
}
