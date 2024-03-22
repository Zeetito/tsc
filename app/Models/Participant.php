<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'residence',
        'room',
        'active_contact',
        'paid',
        'amount',
        'user_id',
        'other_contact',
        'conference_id',
    ];


    // RELATIONSHIPS

    // Return the related Campus
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Return the related Conference
    public function conference(){
        return $this->belongsTo(Conference::class);
    }

    // FUNCTION
    // Check If participant is going for conference
    public function going_for(Conference $conference){
        $ConferenceUser = ConferenceUser::where('user_id',$this->user_id)->where('conference_id',$conference->id)->first();
        return ($this->amount >= $ConferenceUser->amount);
    }

    // Check if participant is a special participant
    public function is_special(Conference $conference){
        // $participant =  $this
        return $conference->special_participants()->whereHas('participant', function ($query) {
            $query->where('participant_id',$this->id);
        })->first() == true;
    }

    // return participant special instnace
    public function special_instance(Conference $conference){
        // $participant =  $this
        return $conference->special_participants()->whereHas('participant', function ($query) {
            $query->where('participant_id',$this->id);
        })->first();
    }
}
