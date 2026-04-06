<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMEvent extends Model
{
    protected $table = 'cm_events';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'capacity',
        'location',
        'is_private',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_private' => 'boolean',
    ];

    public function participants()
    {
        return $this->hasMany(CMEventParticipant::class, 'cm_event_id');
    }
}
