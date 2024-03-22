<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\ConferenceUser;

class ConferenceUserController extends Controller
{
    //

    // Join
    public function join(User $user, Conference $conference){

        // if ($user->is_part_of($conference)){
            
            $instance =  new ConferenceUser;
            $instance->user_id = $user->id;
            $instance->conference_id = $conference->id;

            $instance->save();

            return redirect(route('home'))->with('success','Joined Successfully');

        // } ;

    }

    // Update Conference User Payment
    public function update_payment(User $user, Conference $conference, Request $request){
        if($request->input('paid') == 1 || $request->input('paid')  == 0 ){

            $instance = ConferenceUser::where('user_id',$user->id)->where('conference_id',$conference->id)->first();
            $instance->paid = $request->input('paid');
            $instance->amount = $request->input('amount');
            $instance->save();

            return redirect()->back()->with('success','Update Success');

        }else{
            return redirect()->back()->with('warning','Select A valid response');
        }
    }
}
