@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Payment -')}} {{$user->name}}
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>
                            <form action="{{route('update_conference_user',['conference_user'=>$conference_user])}}" method="post">
                                @csrf
                                @method('put')

                                <a href="{{route('show_conference',['conference'=>$conference])}}" class="float-end">
                                    Back - {{$conference->name}}
                                </a>

                                <div class="row">

                                 
                                    {{-- paid --}}
                                    <div class="col-12 mb-3">
                                        <strong>Are Participants Required to pay an amount? NB:This amount excludes participation fee.</strong>
                                        <select name="paid" class="form-control" id="">
                                            <option value="{{$conference_user->paid == NULL ? "":$conference_user->paid}}">{{$conference_user->paid == NULL ? "Select":($conference_user->paid == 1? "Yes":"No")}}</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        
                                    </div>
                                    @error('paid')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="col-12 mb-3">
                                        <strong>Amount To Be paid</strong>
                                        <input type="number" min="0.00" value="{{old('amount',$conference_user->amount)}}" name="amount" class="form-control" required>
                                        
                                    </div>
                                    @error('amount')
                                        <span class="m=0 small alert alert-danger shadow-sm" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              


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
