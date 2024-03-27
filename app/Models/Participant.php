<?php

namespace App\Models;

use App\Models\ConferenceUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    // Return Gender
    public function get_gender(){
        if($this->gender == "m" )
        {
            return "Male";
        } else{
            return "Female";
        }
            
    }

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

    // return the conferenceUser instance
    public function conferenceUser(){
        return ConferenceUser::where('user_id',$this->user->id)->where('conference_id',$this->conference->id)->first();
    }

    // Return participant's paid status for a conference
    public function paid_status(){
        // <td class="text-danger">{{$participant->paid == 1 && $participant->amount >= $conferenceUser->amount ? "Yes"
            // :($participant->paid == 1 && $participant->amount > 0 ? "Part" : "No" )}}</td>    
        if($this->paid == 1 && $this->amount >= $this->conferenceUser()->amount){
            return "Yes";
        }elseif($this->paid == 1 && $this->amount > 0){
            return "Part";
        }else{
            return "No";
        }
    }
}
