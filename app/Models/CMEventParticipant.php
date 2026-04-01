<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMEventParticipant extends Model
{
    protected $table = 'cm_event_participants';

    protected $fillable = [
        'cm_event_id',
        'full_name',
        'email',
        'phone_number',
        'scanned_at',
        'validation_method',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    public function cmevent()
    {
        return $this->belongsTo(CMEvent::class, 'cm_event_id');
    }
}
