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
        return view('participants\create',['user'=>$user, 'conference'=>$conference]);
    }

    // Store Participant
    public function store(Request $request,  User $user, Conference $conference){
        $validated = $request->validate([
            'name'=>['required','min:5'],
            'active_contact'=>['required','min:10'],
            'other_contact'=>['nullable','min:10'],
            'email'=>['email'],
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
            'email'=>['email'],
            'amount'=>['numeric'],
            'paid'=>['numeric','required'],
        ]);

        $validated['conference_id'] = $participant->conference_id;
        $validated['user_id'] = $participant->user_id;
        $validated['updated_at'] = now();

        $participant->update($validated);

        return redirect(route('user_participants',['user'=>$user, 'conference'=>$conference]))->with('success','Participant Updated');

        


    }
}