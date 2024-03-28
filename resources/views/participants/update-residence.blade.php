@extends('layouts.app')

@section('content')
<div class="m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">Participants' residence @ {{$user->name }}
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>

                                <a href="{{route('user_participants',['user'=>$user,'conference'=>$conference])}}" class="">
                                    Back - {{$conference->name}}
                                </a>

                                <div class="table-responsive">
                                    <form action="{{route('update_bulk_participant_residence',['user'=>$user,'conference'=>$conference])}}" id="special_input" method="post">
                                        @csrf
                                        @method('put')
                                    <table class="table datatable table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Active Contact</th>
                                            <th>Select Participant</th>
                                            <th>Residence</th>
                                            <th>Room</th>
                                        </thead>

                                        <tbody>

                                                @foreach($user->paid_participants_for($conference)->sortByDesc('created_at') as $index => $participant)
                                                <tr>
                                                    
                                                    <td>{{$participant->name}} <input type="text" value="{{$index + 1}}-{{$participant->id}}"> {{--<a href="{{route('edit_participant',['participant'=>$participant])}}">Edit</a>--}}</td>
                                                    <td>{{$participant->gender == "m" ? "Male":"Female"}}</td>
                                                    <td>{{$participant->active_contact}}</td>
                                                  
                                                    @if($participant->residence != NULL)
                                                        <td>
                                                            <input type="checkbox"  name="participants[]"value="{{$participant->id}}" {{'checked'}}>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <input type="checkbox"  name="participants[]"value="{{$participant->id}}" {{ in_array($participant->id, old('participants', [])) ? 'checked' : '' }}>
                                                        </td>
                                                    @endif





                                                

                                                    {{-- Residence --}}
                                                        {{-- @if($participant->residence != NULL) --}}
                                                            {{-- <td>
                                                                <textarea type="text"  name="residences[]">
                                                                    {{$participant->residence}}
                                                                </textarea>
                                                            </td> --}}
                                                        {{-- @else --}}
                                                            <td>
                                                                <textarea type="text"  name="residences[]">
                                                                    {{ old('residences.' . $index + 1,$participant->residence) }}
                                                                </textarea>
                                                            </td>
                                                        {{-- @endif --}}


                                                    {{-- residence Ends --}}

                                                    {{-- Room --}}
                                                        {{-- @if($participant->room != NULL) --}}
                                                            {{-- <td>
                                                                <textarea type="text"  name="rooms[]">
                                                                    {{$participant->room}}
                                                                </textarea>
                                                            </td> --}}
                                                        {{-- @else --}}
                                                            <td>
                                                                <textarea type="text"  name="rooms[]">
                                                                    {{ old('rooms.' . $index + 1,$participant->room) }}
                                                                </textarea>
                                                            </td>
                                                        {{-- @endif --}}


                                                    {{-- room Ends --}}

                                                </tr>
                                                @endforeach

                                            </form>
                                        </tbody>
                                    </table>
                                    
                                    
                                    <input form="special_input" type="submit" class="form-control bg-success text-white" name="submit" value="Save">
                                </div>

                                 
                        </div>

                    {{-- @endif --}}

                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
