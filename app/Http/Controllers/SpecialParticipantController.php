<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\SpecialParticipant;

class SpecialParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Conference $conference)
    {
        //
        return view('special-participants.index',['conference'=>$conference]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user, Conference $conference)
    {
        return view('special-participants.create',['conference'=>$conference,'user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user, Conference $conference)
    {
        if($request->input('participants')){
            $validated_participants = $request->validate([
                'participants'=>['required','array'],
                'categories'=>['required'],
                'info'=>['required'],
            ]);

            $participants = array_map('intval',$validated_participants['participants']);
            $categories = array_values(array_filter($validated_participants['categories']));
            $info = array_values(array_filter($validated_participants['info']));


            $db_special_participants =  $conference->special_participants;
            $db_categories = $db_special_participants->pluck('category')->toArray();
            $db_info = $db_special_participants->pluck('info')->toArray();
            $db_participants = $db_special_participants->pluck('participant_id')->toArray();
           

            
            // Check if what's there is same as what's coming
            if($db_categories == $categories && $db_info == $info && $db_participants == $participants){
                return redirect()->back()->with('warning','no change detected');
            }

            if(sizeof($info) == sizeof($participants) && sizeof($categories) == sizeof($participants)){
                    foreach($participants as $index => $participant){
                        $instance = new SpecialParticipant;
                        $instance->participant_id = $participant;
                        $instance->category = $categories[$index];
                        $instance->info = $info[$index];
                        $instance->save();
                    }

                    return redirect()->back()->with('success','Special Participants Added successfully!');
            }else{
                return redirect()->back()->with('failure','Kindly fill in all necessary details!')->withInput();
            }

        }else{
            return redirect()->back()->with('failure','Please Select A Participant');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialParticipant $specialParticipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialParticipant $specialParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialParticipant $specialParticipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialParticipant $specialParticipant)
    {
        //
    }
}
