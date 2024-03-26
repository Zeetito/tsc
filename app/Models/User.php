<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Conference;
use App\Models\ConferenceUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // NB: Users are representations of the various Campuses

    // RELATIONSHIPS
    
    // Return related Conferences
    public function conferences(){
        return $this->hasMany(Conference::class);
    }

    // return All Participants a user
    public function participants(){
        return $this->hasMany(Participant::class);
    }

    // return all participants of a user for a particular conference
    public function participants_for(Conference $conference){
        return Participant::whereBelongsTo($conference)->get()->intersect($this->participants);
    }

    // return all participants of a user for a particular conference
    public function paid_participants_for(Conference $conference){
        $conferenceUser = ConferenceUser::where('user_id',$this->id)->where('conference_id',$conference->id)->first();
        return Participant::where('paid',1)->where('amount','>=',$conferenceUser->amount)->whereBelongsTo($conference)->get()->intersect($this->participants);
    }


    // FUNCTIONS

    // Check if user is current host
    public function is_host(){
        return $this->is_host == 1;
    }

    // Check if user is part of a conference
    public function is_part_of(Conference $conference){
        return $conference->users->contains($this);
    }

    // Check if user has stated their paid status for a confrerence
    public function paid_status_set_for(Conference $conference){
        return ConferenceUser::where('user_id',$this->id)->where('conference_id',$conference->id)->first()->paid != NULL;
    }







}
