@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Participant Details') }}
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>
                            <form action="{{route('update_participant',['participant'=>$participant])}}" method="post">
                                @csrf
                                @method('put')

                                <a href="{{route('user_participants',['user'=>$user,'conference'=>$conference])}}" class="float-end">
                                    Back - {{$conference->name}}
                                </a>

                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <strong>Name</strong>
                                        <input type="text" value="{{old('name',$participant->name)}}" name="name" class="form-control" placeholder="name of individual" required>
                                        
                                    </div>
                                    @error('name')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- Gender --}}
                                    <div class="col-12 mb-3">
                                        <strong>Gender</strong>
                                        <select name="gender" class="form-control" id="">
                                            <option value="{{$participant->gender}}">{{$participant->gender == "m" ? "Male":"Female"}}</option>
                                            <option value="m">Male</option>
                                            <option value="f">Femail</option>
                                        </select>
                                        
                                    </div>
                                    @error('name')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="col-12 mb-3">
                                        <strong>Active Contact</strong>
                                        <input type="text" value="{{old('active_contact',$participant->active_contact)}}" name="active_contact" class="form-control" required>
                                        
                                    </div>
                                    @error('active_contact')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <div class="col-12 mb-3">
                                        <strong>Other Contact</strong>
                                        <input type="text" value="{{old('other_contact',$participant->other_contact)}}" name="other_contact" class="form-control" >
                                        
                                    </div>
                                    @error('other_contact')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="col-12 mb-3">
                                        <strong>Email</strong>
                                        <input type="email" value="{{old('email',$participant->email)}}" name="email" class="form-control" >
                                        
                                    </div>
                                    @error('email')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                    @if(App\Models\ConferenceUser::where('user_id',$user->id)->where('conference_id',$conference->id)->first()->paid == 1)

                                        {{-- Paid --}}
                                         <div class="col-12 mb-3">
                                            <strong>Paid ?</strong>
                                            <p>{{$participant->paid == 1 ? "Yes":"No"}}</p>
                                            <select name="paid" id="" value="{{old('paid',$participant->paid)}}" class="form-control" required>
                                                <option value="{{$participant->paid}}">Select</option>
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
                                            <strong>Amount</strong>
                                            <input name="amount" type="text" value="{{old('amount',$participant->amount)}}" id="" class="form-control" required>
                                        </div>
                                        @error('amount')
                                            <span class="m=0 small alert alert-danger shadow-sm" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @else
                                            
                                        <input type="text" value="1" hidden name="paid">
                                        <input type="text" value="0.00" hidden name="amount">
                                    @endif 



                                    <div class="col-12 mb-3">
                                        <input type="submit" value="Update Participant" name="submit" class="btn-info form-control" >

                                    </div>

                                </div>
                            </form>
                        </div>

                    {{-- @endif --}}

                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
