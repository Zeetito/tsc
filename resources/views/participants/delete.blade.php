@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Delete Participant') }}
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>
                            <form action="{{route('delete_participant',['participant'=>$participant])}}" method="post">
                                @csrf
                                @method('delete')

                                <a href="{{route('user_participants',['user'=>$user,'conference'=>$conference])}}" class="float-end">
                                    Back - {{$conference->name}}
                                </a>

                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <strong>Name</strong>
                                        <input type="text" value="{{$participant->name}}" readonly name="name" class="form-control" placeholder="name of individual" required>
                                        
                                    </div>
                                    @error('name')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="col-12 mb-3">
                                        <strong>Active Contact</strong>
                                        <input type="text" value="{{$participant->active_contact}}" readonly name="active_contact" class="form-control" required>
                                        
                                    </div>
                                    @error('active_contact')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <div class="col-12 mb-3">
                                        <strong>Other Contact</strong>
                                        <input type="text" value="{{$participant->other_contact}}" readonly name="other_contact" class="form-control" >
                                        
                                    </div>
                                    @error('other_contact')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="col-12 mb-3">
                                        <strong>Email</strong>
                                        <input type="email" value="{{$participant->email}}" readonly name="email" class="form-control" required>
                                        
                                    </div>
                                    @error('email')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                    {{-- @if($conference->paid == 1) --}}
                                        {{-- Paid --}}
                                        {{-- <div class="col-12 mb-3">
                                            <strong>Paid ?</strong>
                                            <select name="paid" id="" class="form-control" required>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        @error('paid')
                                            <span class="m=0 small alert alert-danger shadow-sm" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                        {{-- Amount Paid --}}
                                        {{-- <div class="col-12 mb-3">
                                            <strong>Amount</strong>
                                            <input name="amount" type="text" id="" class="form-control" required>
                                        </div>
                                        @error('amount')
                                            <span class="m=0 small alert alert-danger shadow-sm" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @else
                                            
                                        <input type="text" value="1" hidden name="paid">
                                        <input type="text" value="0.00" hidden name="amount">
                                    @endif --}}



                                    <div class="col-12 mb-3">
                                        <input type="submit" value="Delete Participant" name="submit" class="btn-info form-control" >

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
