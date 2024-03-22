<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\ConferenceUser;

class ConferenceController extends Controller
{
    //

    // Create Conference
    public function create(){
        return view('conferences.create');
    }
    
    // Store Conference
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['min:5','required'],
            'start_date' => ['date','required'],
            'end_date' => ['date','required'],
        ]);

        $validated['user_id'] = auth()->id();

        // return $validated;

        $conference = Conference::Create($validated);

        $instance = new ConferenceUser;
        $instance->user_id = auth()->id();
        $instance->conference_id = $conference->id;
        $instance->save();

        return redirect()->route('home')->with('success','Conference Started Successfully');
    }

    // Show Conference
    public function show(Conference $Conference){
        return view('conferences.show',['conference'=>$Conference]);
    }

    // Show All Participants...
    public function participants(Conference $conference){

        // $conferenceUser = ConferenceUser::where('user_id',$conference->user_id)->where('conference_id',$conference->id)->first();

        $participants = $conference->participants;
        
        return view('conferences.participants',['participants'=>$participants,'conference'=>$conference,'user'=>$conference->user]);
    }
}
