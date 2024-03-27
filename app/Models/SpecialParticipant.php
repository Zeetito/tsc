<?php

namespace App\Models;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialParticipant extends Model
{
    use HasFactory;

    protected $defaultOrderBy = 'created_at'; // Default column to sort by
    protected $defaultOrderDirection = 'desc'; // Default sorting direction ('asc' or 'desc')

    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        if (!empty($this->defaultOrderBy)) {
            $query->orderBy($this->defaultOrderBy, $this->defaultOrderDirection);
        }

        return $query;
    }

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
