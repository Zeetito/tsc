@extends('layouts.app')

@section('content')
<div class="m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">Special Participant @ {{$user->name }}
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>

                                <a href="{{route('user_participants',['user'=>$user,'conference'=>$conference])}}" class="">
                                    Back - {{$conference->name}}
                                </a>

                                <div class="table-responsive">
                                    <form action="{{route('store_special_participant',['user'=>$user,'conference'=>$conference])}}" id="special_input" method="post">
                                        @csrf
                                    <table class="table datatable table-striped ">
                                        <thead>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Select</th>
                                            <th>Category</th>
                                            <th>Info</th>
                                            <th>Action(s)</th>
                                        </thead>

                                        <tbody>

                                            @php
                                                $index = 1; // Define the initial value for $index
                                            @endphp

                                                @foreach($user->paid_participants_for($conference) as $index => $participant)
                                                <tr>
                                                    
                                                    <td>{{$participant->name}} {{--<a href="{{route('edit_participant',['participant'=>$participant])}}">Edit</a>--}}</td>
                                                    <td>{{$participant->gender == "m" ? "Male":"Female"}}</td>
                                                    {{-- Select Participant --}}
                                                    @if($participant->is_special($conference))
                                                        <td>
                                                            <input type="checkbox"  name="participants[]"value="{{$participant->id}}" {{'checked'}}>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <input type="checkbox"  name="participants[]"value="{{$participant->id}}" {{ in_array($participant->id, old('participants', [])) ? 'checked' : '' }}>
                                                        </td>
                                                    @endif
                                                    @error('participants.' . $index + 1)
                                                        <span class="m=0 small alert alert-danger shadow-sm">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror



                                                    {{-- Select Participant ends --}}


                                                    {{-- Categories --}}
                                                    @if($participant->is_special($conference))
                                                    <td>
                                                        <select name="categories[]" >
                                                         <option value="">Select</option>
                                                         <option value="food" {{ $participant->special_instance($conference)->category == 'food' ? 'selected' : '' }}>Food</option>
                                                         <option value="disability" {{ $participant->special_instance($conference)->category == 'disability' ? 'selected' : '' }}>Disability</option>
                                                         <option value="allergy" {{ $participant->special_instance($conference)->category == 'allergy' ? 'selected' : '' }}>Allergy</option>
                                                        </select>
                                                     </td>
                                                    @else
                                                    <td>
                                                       <select name="categories[]" >
                                                        <option value="">Select</option>
                                                        <option value="food" {{ old('categories.' . $index + 1) == 'food' ? 'selected' : '' }}>Food</option>
                                                        <option value="disability" {{ old('categories.' . $index + 1) == 'disability' ? 'selected' : '' }}>Disability</option>
                                                        <option value="allergy" {{ old('categories.' . $index + 1) == 'allergy' ? 'selected' : '' }}>Allergy</option>
                                                       </select>
                                                       
                                                    </td>
                                                    @endif

                                                    @error('categories.' . $index + 1)
                                                        <span class="m=0 small alert alert-danger shadow-sm">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror


                                                    {{-- Category ends --}}

                                                    {{-- Info --}}
                                                        @if($participant->is_special($conference))
                                                        <td>
                                                            <textarea type="text"  name="info[]">
                                                                {{ $participant->special_instance($conference)->info }}
                                                            </textarea>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <textarea type="text"  name="info[]">
                                                                {{ old('info.' . $index + 1) }}
                                                            </textarea>
                                                        </td>
                                                        @endif

                                                        @error('info.' . $index + 1)
                                                            <span class="m=0 small alert alert-danger shadow-sm">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror


                                                    {{-- info Ends --}}

                                                    {{-- Actions --}}

                                                    <td>
                                                        @if($participant->is_special($conference))
                                                            <a href="{{route('confirm_special_participant_delete',['specialParticipant'=>$participant->special_instance($conference)])}}">Delete</a>
                                                        @else
                                                            {{""}}
                                                        @endif
                                                    </td>
                                            
                                                    {{-- Actions End here --}}

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
