<?php

namespace App\Models;

use App\Models\User;
use App\Models\Conference;
use App\Models\Participant;
use App\Models\ConferenceUser;
use App\Models\SpecialParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conference extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'user_id',
        'start_date',
        'end_date',
        'is_active',
        'in_session',
    ];

    // RELATIONSHIPS
    
    // Return Related User/Campus
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Return related participants
    public function participants(){
        return $this->hasMany(Participant::class);
    }

    // return participating campuses or users
    public function users(){
        return $this->BelongsToMany(User::class,ConferenceUser::class);
    }

    // Special participants
    public function special_participants(){
        return $this->hasManyThrough(SpecialParticipant::class,Participant::class);
    }


    // FUNCTIONS
    



    // STATIC FUNCTIONS

    // return Active Conference
    public static function active_conference(){
        return Conference::where('is_active',1)->first();
    }

    // return conference in session
    public static function in_session(){
        return Conference::where('is_active',1)->where('in_session',1)->first();
    }


}
