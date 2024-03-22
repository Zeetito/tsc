@extends('layouts.app')

@section('content')
<div class="m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">Special Participant @ {{$user->name }}
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>

                                <a href="{{route('user_participants',['user'=>$user,'conference'=>$conference])}}" class="float-end">
                                    Back - {{$conference->name}}
                                </a>

                                <div class="">
                                    <form action="{{route('store_special_participant',['user'=>$user,'conference'=>$conference])}}" id="special_input" method="post">
                                        @csrf
                                    <table class="table datatable table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Select</th>
                                            <th>Category</th>
                                            <th>Info</th>
                                        </thead>

                                        <tbody>

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
                                                        <option value="food" {{ old('categories.' . $index) == 'food' ? 'selected' : '' }}>Food</option>
                                                        <option value="disability" {{ old('categories.' . $index) == 'disability' ? 'selected' : '' }}>Disability</option>
                                                        <option value="allergy" {{ old('categories.' . $index) == 'allergy' ? 'selected' : '' }}>Allergy</option>
                                                       </select>
                                                    </td>
                                                    @endif


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
                                                                {{ old('info.' . $index) }}
                                                            </textarea>
                                                        </td>
                                                        @endif


                                                    {{-- info Ends --}}

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
