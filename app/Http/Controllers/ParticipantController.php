<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conference;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    //

    // Create Participant
    public function create(User $user, Conference $conference){
        return view('participants.create',['user'=>$user, 'conference'=>$conference]);
    }

    // Store Participant
    public function store(Request $request,  User $user, Conference $conference){
        $validated = $request->validate([
            'name'=>['required','min:5'],
            'active_contact'=>['required','min:10'],
            'other_contact'=>['nullable','min:10'],
            'email'=>['email','nullable'],
            'gender'=>['required'],
            'amount'=>['numeric'],
            'paid'=>['numeric','required'],
        ]);

        $validated['conference_id'] = $conference->id;
        $validated['user_id'] = $user->id;

        if($validated['other_contact']  == null){
            $validated['other_contact'] = $validated['active_contact'];
        }

        Participant::create($validated);

        return redirect()->back()->with('success','Participant Added Successfully!');
    }

    // Confirm Delete
    public function confirm_delete(Participant $participant){
        $user = $participant->user;
        $conference = $participant->conference;
        return view('participants.delete',['participant'=>$participant,'user'=>$user,'conference'=>$conference]);
    }

    // Delete participant
    public function delete(Request $request, Participant $participant){
        $conference = $participant->conference;
        $user = $participant->user;
        if($participant){
            $participant->delete();
            return redirect(route('user_participants',['user'=>$user, 'conference'=>$conference]))->with('warning','Participant Permanently deleted!');
        }else{
            return redirect(route('user_participants',['user'=>$user, 'conference'=>$conference]))->with('danger','Participant does not exist!');
        }
    }

    // Edit Participant
    public function edit(Participant $participant){
        $conference = $participant->conference;
        $user = $participant->user;
        return view('participants.edit',['user'=>$user, 'conference'=>$conference,'participant'=>$participant]);
    }

    // Update Participant
    public function update(Participant $participant, Request $request){
        $user = $participant->user;
        $conference = $participant->conference;
        $validated = $request->validate([
            'name'=>['required','min:5'],
            'active_contact'=>['required','min:10'],
            'other_contact'=>['nullable','min:10'],
            'gender'=>['required'],
            'email'=>['email','nullable'],
            'amount'=>['numeric'],
            'paid'=>['numeric','required'],
        ]);

        $validated['conference_id'] = $participant->conference_id;
        $validated['user_id'] = $participant->user_id;
        $validated['updated_at'] = now();

        $participant->update($validated);

        return redirect(route('user_participants',['user'=>$user, 'conference'=>$conference]))->with('success','Participant Updated');

        


    }

    // bulk_residence_edit
    public function bulk_residence_edit(User $user, Conference $conference){
        return view('participants.update-residence',['user'=>$user, 'conference'=>$conference]);
    }

    // update bulk residence
    public function bulk_residence_update(Request $request,User $user, Conference $conference){
        if($request->input('participants')){
            $validated_participants = $request->validate([
                'participants'=>['required','array'],
                'residences'=>['required'],
                'rooms'=>['required'],
            ]);
            // Storing Values from form
            $participants = array_map('intval',$validated_participants['participants']);
            $residences = array_values(array_filter($validated_participants['residences']));
            $rooms = array_values(array_filter($validated_participants['rooms']));


            // Storing Values from DB
            $db_participants = array_values(array_filter($user->paid_participants_for($conference)->where('residence','<>',NULL)->pluck('id')->toArray()));
            $db_residences = array_values(array_filter($user->paid_participants_for($conference)->pluck('residence')->toArray()));
            $db_rooms = array_values(array_filter($user->paid_participants_for($conference)->pluck('room')->toArray()));

             // Check if what's there is same as what's coming
             if($db_residences == $residences && $db_rooms == $rooms && $db_participants == $participants){
                // return ( [$db_residences, $residences, $db_rooms, $rooms, $db_participants, $participants]);

                return redirect()->back()->with('warning','no change detected');
            }

            // else{return ( [$db_residences, $residences, $db_rooms, $rooms, $db_participants, $participants]);}


             // If there's a difference
             if(sizeof($residences) == sizeof($participants) && sizeof($rooms) == sizeof($participants)){
                foreach($participants as $index => $participant){
                    // Check if the instance exist for update instead of insert
                        $participant_instance =  Participant::find($participant);
                        $participant_instance->residence = $residences[$index];
                        $participant_instance->room = $rooms[$index];
                        $participant_instance->save();
                }

                return redirect()->back()->with('success','Participants Residence Details Updated Successfully!');
                
            }else{
                return redirect()->back()->with('failure','Kindly fill in all necessary details!')->withInput();
            }

        }else{
            return redirect()->back()->with('failure','Please Select A Participant. Please Select a participant.');
        }
    }
}