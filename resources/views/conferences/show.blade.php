@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{$conference->name}}
                

                        {{-- If User Is not part of the participating campuses --}}
                        @if(auth()->user()->is_part_of($conference))
                        <a class="float-end" href="{{route('edit_conference_user',['user'=>auth()->user(),'conference'=>$conference])}}">Edit Payment</a>

                            

                            <div class="container row">

                                <div class="rounded card m-2 col-12 h6 text-center">
                                    <span class="rounded bg-success btn text-white mb-2">
                                        Participating Campuses
                                    </span>

                                    <div>
                                        @foreach($conference->users as $user)
                                            <div>
                                                <a class="btn btn-secondary mb-2" href="{{route('user_participants',['user'=>$user, 'conference'=>$conference])}}">{{$user->name}}</a>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                <div class="rounded card m-2 col-12 h6 text-center">
                                    <span class="rounded bg-success btn text-white mb-2">
                                        View All Participants
                                    </span>

                                    <div>
                                        {{-- @foreach($conference->users as $user) --}}
                                            <div>
                                                <a class="btn btn-secondary mb-2" href="{{route('conference_participants',['conference'=>$conference])}}">All Participants</a>
                                            </div>
                                        {{-- @endforeach --}}
                                    </div>

                                </div>

                                <div class="rounded card m-2 col-12 h6 text-center">
                                    <span class="rounded bg-success btn text-white mb-2">
                                        View Special Participants
                                    </span>

                                    <div>
                                        {{-- @foreach($conference->users as $user) --}}
                                            <div>
                                                <a class="btn btn-secondary mb-2" href="{{route('special_participants',['conference'=>$conference])}}">Special Participants</a>
                                            </div>
                                        {{-- @endforeach --}}
                                    </div>

                                </div>

                            </div>

                        @else
                            <a class="btn btn-info float-end" href="{{route('conference_join',['user'=>auth()->user(),'conference'=>$conference])}}" >
                                Join Conference
                            </a>
                        @endif

                </div>
                
            </div>
        {{-- </div> --}}
    </div>
</div>
@endsection
