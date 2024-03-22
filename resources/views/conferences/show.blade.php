@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{$conference->name}}
                

                        {{-- If User Is not part of the participating campuses --}}
                        @if(auth()->user()->is_part_of($conference))
                            {{-- Some Options at the Nav Top --}}
                            {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> --}}
                                {{-- <div class="container"> --}}
                                {{--  --}}
                                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Campuses" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"> --}}
                                        {{-- <span class="navbar-toggler-icon"></span> --}}
                                    {{-- </button> --}}
                    {{--  --}}
                                    {{-- <div class="collapse navbar-collapse" id="Campuses"> --}}
                                        {{-- <!-- Left Side Of Navbar --> --}}
                                        {{-- <ul class="navbar-nav me-auto"> --}}
                    {{--  --}}
                                        {{-- </ul> --}}
                    
                                        <!-- Right Side Of Navbar -->
                                        {{-- <ul class="navbar-nav ms-auto"> --}}
                {{--  --}}
                                                {{-- <li class="nav-item dropdown"> --}}
                                                    {{-- <a id="campuses_dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> --}}
                                                        {{-- {{ Auth::user()->name }} --}}
                                                        {{-- CAMPUSES --}}
                                                    {{-- </a> --}}
                    {{--  --}}
                                                    {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="campuses_dropdown"> --}}
                                                        {{-- @foreach($conference->users as $user) --}}
                                                            {{-- <a class="dropdown-item" href="{{route('user_participants',['user'=>$user, 'conference'=>$conference])}}"> --}}
                                                                {{-- {{ $user->name}} - ({{$user->participants_for($conference)->where('amount','>=',App\Models\ConferenceUser::where('user_id',$user->id)->where('conference_id',$conference->id)->first()->amount)->count()}}) --}}
                                                            {{-- </a> --}}
                                                        {{-- @endforeach --}}
{{--  --}}
                                                    {{-- </div> --}}
                                                {{-- </li> --}}
{{--  --}}
                                                {{-- <li> --}}
                                                    {{-- <a href="{{route('conference_participants',['conference'=>$conference])}}" class="nav-link"> --}}
                                                        {{-- ALL PARTICIPANTS --}}
                                                    {{-- </a> --}}
                                                {{-- </li> --}}
                                        {{-- </ul> --}}
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            {{-- </nav> --}}
                            

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
