<?php

namespace App\Models;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'category',
        'info',
    ];

    // RELATIONSHIPS
    // Related participant
    public function participant(){
        return $this->belongsTo(Participant::class);
    }
}
