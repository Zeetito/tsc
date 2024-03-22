@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{$conference->name}} - SPECIAL PARTICIPANTS 
                
                    
                        
                            <a class="btn btn-info mr-2 float-end" href="{{route('show_conference',['conference'=>$conference])}}" >
                                Back To {{$conference->name}}
                            </a>

                    {{-- If Participants more than Zero... --}}

                </div>


                <div class="card-body">
                
                    @if($conference->special_participants->count() > 0)

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
                                        <th>Category</th>    
                                        <th>Info</th>
                                        <th>Campus</th>    
                                        {{-- @if(auth()->user()->is($user)) 
                                            <th>Actions</th>
                                        @endif --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($conference->special_participants as $special_participant)
                                        @if($special_participant->participant->going_for($conference))
                                            <tr>
                                                <td>
                                                    {{$special_participant->participant->name}}
                                                </td>
                                                <td>
                                                    {{$special_participant->participant->gender == "m" ? "Male":"Female"}}
                                                </td>
                                                <td>
                                                    {{$special_participant->participant->active_contact}}
                                                </td>
                                                <td>
                                                    {{$special_participant->category}}
                                                </td>
                                                <td>
                                                    {{$special_participant->info}}
                                                </td>
                                                <td>
                                                    {{$special_participant->participant->user->name}}
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
