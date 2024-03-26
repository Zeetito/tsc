@extends('layouts.app')

@section('content')
<div class="p-3">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{$conference->name}} @ {{$user->name}}
                
                    <div class="row">
                        {{-- If the User is the Campus --}}
                        @if(auth()->user()->is($user))
                            {{-- <a class="btn btn-danger col-3 m-2 " href="{{route('confirm_exit_conference',['user'=>$user,'conference'=>$conference])}}" >
                                Exit Conference
                            </a> --}}

                            @if($conferenceUser)
                                <a class="btn btn-info text-white col-3 m-2 " href="{{route('create_participant',['user'=>$user,'conference'=>$conference])}}" >
                                    Add Participant
                                </a>

                                {{-- Speicial Participants --}}
                                <a class="btn btn-info text-white col-3 m-2 " href="{{route('create_special_participant',['user'=>$user,'conference'=>$conference])}}" >
                                    Indicate Special Participants
                                </a>
                            @endif

                        @endif

                        
                        <a class="btn btn-info text-white mr-2 col-3 m-2 " href="{{route('show_conference',['conference'=>$conference])}}" >
                            Back To {{$conference->name}}
                        </a>

                    </div>
                  
                   
                    


                    {{-- If Participants more than Zero... --}}

                    
                    
                </div>


                <div class="card-body">

                    @if((!$conferenceUser || $conferenceUser->paid == NULL))

                            @if(auth()->user()->is($user))

                                <div>
                                    <form action="{{route('update_conference_payment',['user'=>$user, 'conference'=>$conference])}}" method="post">
                                        @csrf
                                        @method('put')

                                    

                                        <div class="row">
                                                {{-- Paid --}}
                                                <div class="col-12 mb-3">
                                                    <strong>Participants from {{$user->name}} are supposed to make payment(eg. T&T) ?</strong>
                                                    <p class="text-center">NB: this payment is does not include Participation fee!</p>
                                                    <select name="paid" id="" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                                @error('paid')
                                                    <span class="m=0 small alert alert-danger shadow-sm" >
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                {{-- Amount Paid --}}
                                                <div class="col-12 mb-3">
                                                    <strong>What Amount</strong>
                                                    <input name="amount" value="0.00" type="text" id="" class="form-control" required>
                                                </div>
                                                @error('amount')
                                                    <span class="m=0 small alert alert-danger shadow-sm" >
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror




                                            <div class="col-12 mb-3">
                                                <input type="submit" value="Confirm" name="submit" class="btn-info form-control" >

                                            </div>

                                        </div>

                                    </form>
                                </div>

                            @else
                                <div>No Info To Show Here.</div>
                            @endif
                    @else
                
                        @if($participants->count() > 0)

                            <div>

                                <table class="table table-striped datatable">
                                    <caption class="h2">
                                        Participants From {{$user->name}}
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Active Contact</th>
                                            <th>Other Contact</th>
                                            <th>Email</th>    
                                            @if(auth()->user()->is($user)) 
                                            
                                                @if($conferenceUser->paid == 1)
                                                    <th>Paid</th>    
                                                    <th>Amount</th>    

                                                @endif

                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- Participants Who have paid --}}
                                        @foreach($participants->where('amount','>=',$conferenceUser->amount) as $participant)
                                            <tr>
                                                <td>
                                                    {{$participant->name}}
                                                </td>
                                                <td>
                                                    {{$participant->gender == "m" ? "Male":"Female"}}
                                                </td>
                                                <td>
                                                    {{$participant->active_contact}}
                                                </td>
                                                <td>
                                                    {{$participant->other_contact ? $participant->other_contact : "None"}}
                                                </td>
                                                <td>
                                                    {{$participant->email}}
                                                </td>
                                                @if(auth()->user()->is($user)) 

                                                    @if($conferenceUser->paid == 1)
                                                        <td>{{$participant->paid == 1 ? "Yes":"No"}}</td>    
                                                        <td>{{$participant->amount }}</td>    

                                                    @endif

                                                    <td>
                                                        <a href="{{route('confirm_participant_delete',['participant'=>$participant])}}" class="btn btn-danger">Delete</a>
                                                        <a href="{{route('edit_participant',['participant'=>$participant])}}" class="btn btn-secondary">Edit</a>
                                                    </td>

                                                @endif
                                            </tr>
                                        @endforeach


                                        {{-- Participants Who have not paid --}}
                                        @if($user->is(auth()->user()))
                                            @foreach($participants->where('amount','<',$conferenceUser->amount) as $participant)
                                                <tr class="">
                                                    <td>
                                                        {{$participant->name}}
                                                    </td>
                                                    <td>
                                                        {{$participant->gender == "m" ? "Male":"Female"}}

                                                    </td>
                                                    <td>
                                                        {{$participant->active_contact}}
                                                    </td>
                                                    <td>
                                                        {{$participant->other_contact ? $participant->other_contact : "None"}}
                                                    </td>
                                                    <td>
                                                        {{$participant->email}}
                                                    </td>
                                                    @if(auth()->user()->is($user)) 

                                                        @if($conferenceUser->paid == 1)
                                                             <td class="text-danger">{{$participant->paid == 1 && $participant->amount >= $conferenceUser->amount ? "Yes":($participant->paid == 1 && $participant->amount > 0 ? "Part" : "No" )}}</td>    
                                                             <td class="text-danger" >{{$participant->amount }}</td>    

                                                        @endif

                                                        <td>
                                                            <a href="{{route('confirm_participant_delete',['participant'=>$participant])}}" class="btn btn-danger">Delete</a>
                                                            <a href="{{route('edit_participant',['participant'=>$participant])}}" class="btn btn-secondary">Edit</a>
                                                        </td>

                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>

                                </table>

                            </div>

                        @else
                            <div class="align-self-center btn btn-warning" >
                                No Participants from {{$user->name}}
                            </div>
                            {{-- <div class="align-self-center btn btn-warning" >
                                Add Participants {{$user->name}}
                            </div> --}}
                            
                        @endif

                    @endif

                </div>

                
            </div>
        {{-- </div> --}}
    </div>
</div>
@endsection
