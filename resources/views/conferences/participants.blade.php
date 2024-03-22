@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{$conference->name}} - PARTICIPANTS 
                
                    
                        
                            <a class="btn btn-info mr-2 float-end" href="{{route('show_conference',['conference'=>$conference])}}" >
                                Back To {{$conference->name}}
                            </a>

                    {{-- If Participants more than Zero... --}}

                </div>


                <div class="card-body">
                
                    @if($participants->count() > 0)

                        <div>

                            <table class="table table-striped datatable">
                                <caption class="h2">
                                    Participants From All Campuses
                                </caption>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Active Contact</th>
                                        <th>Other Contact</th>
                                        <th>Email</th>    
                                        <th>Campus</th>    
                                        {{-- @if(auth()->user()->is($user)) 
                                            <th>Actions</th>
                                        @endif --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($participants as $participant)
                                        @if($participant->going_for($conference))
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
                                                <td>
                                                    {{$participant->user->name}}
                                                </td>
                                                {{-- @if(auth()->user()->is($user)) 
                                                    <td>
                                                        <a href="{{route('confirm_participant_delete',['participant'=>$participant])}}" class="btn btn-danger">Delete</a>
                                                        <a href="{{route('edit_participant',['participant'=>$participant])}}" class="btn btn-secondary">Edit</a>
                                                    </td>

                                                @endif --}}
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>

                            </table>

                        </div>

                    @else
                        <div class="align-self-center btn btn-warning" >
                            No Participants to show
                        </div>
                        
                    @endif
                </div>

                
            </div>
        {{-- </div> --}}
    </div>
</div>
@endsection
