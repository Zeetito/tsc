@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Delete Participant') }}
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>
                            <form action="{{route('delete_special_participant',['specialParticipant'=>$specialParticipant])}}" method="post">
                                @csrf
                                @method('delete')

                                <a href="{{route('create_special_participant',['user'=>$specialParticipant->participant->user,'conference'=>$specialParticipant->participant->conference])}}" class="float-end">
                                    Back - {{$specialParticipant->participant->conference->name}}
                                </a>

                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <strong>Name</strong>
                                        <input type="text" value="{{$specialParticipant->participant->name}}" readonly class="form-control" placeholder="name of individual" required readonly>
                                        
                                    </div>
                                   
                                    <div class="col-12 mb-3">
                                        <strong>Gender</strong>
                                        <input type="text" value="{{$specialParticipant->participant->get_gender()}}" readonly class="form-control" placeholder="name of individual" required readonly>
                                        
                                    </div>

                                    <div class="col-12 mb-3">
                                        <strong>Category</strong>
                                        <input type="text" value="{{$specialParticipant->category}}" readonly class="form-control" placeholder="name of individual" required readonly>
                                        
                                    </div>

                                    <div class="col-12 mb-3">
                                        <strong>Info</strong>
                                        <input type="text" value="{{$specialParticipant->info}}" readonly class="form-control" placeholder="name of individual" required readonly>
                                        
                                    </div>


                                    
                                  
                              



                                    <div class="col-12 mb-3">
                                        <input type="submit" value="Delete" name="submit" class="btn-info form-control" >

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
