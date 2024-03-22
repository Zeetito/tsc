<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conference;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\ConferenceUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    // view User's participants
    public function participants(User $user, Conference $conference){
            $participants = $user->participants_for($conference);
            $conferenceUser = ConferenceUser::where('user_id',$user->id)->where('conference_id',$conference->id)->first();
            return view('user.participants',['user'=>$user, 'conference'=>$conference, 'participants'=>$participants,'conferenceUser'=>$conferenceUser]);
    }

    // Confirm Exit Conference
    public function confirm_exit_conference(User $user, Conference $conference){
        return view('user.conferences.confirm-exit',['user'=>$user,'conference'=>$conference]);
    }

    // Exit Conference
    public function exit_conference(Request $request, User $user, Conference $conference){
        $instance = ConferenceUser::where('user_id',$user->id)->where('conference_id',$conference->id)->first();

        if($instance){
            $participants = Participant::where('user_id',$user->id)->where('conference_id',$conference->id)->get();
            if($participants->count() > 0){
                foreach($participants as $participant){
                    $participant->delete();
                }
            }
            $instance->delete();

            return redirect(route('home'))->with('warning','You Have Exited The Conference');
            
        }else{
            return redirect()->back()->with('warning','Instance does not exist');
        }
    }    

    // Confrim transfer host
    public function transfer_host_confirm(){
        return view('user.transfer-host');
    }

    // Transfer Host
    public function transfer_host(Request $request){
        
        $user = User::find($request->input('user_id'));
        if($user){

            if($user->is(auth()->user())){
                return redirect(route('home'))->with('warning','You are already the Host');
            }

            $auth =  auth()->user();
            $auth->is_host = 0;
            $user->is_host = 1;
            
            $auth->save();
            $user->save();

            return redirect(route('home'))->with('warning','Host Transferred Successfully');

        }else{
            return redirect(route('home'))->with('failure','User does not exist');
        }

    }





}
