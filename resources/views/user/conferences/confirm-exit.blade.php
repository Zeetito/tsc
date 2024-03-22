@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">You are <strong>Leaving</strong> {{$conference->name}}

                    <p>
                        This means all registered participants will be cleared from the system.
                    </p>
                
                    {{-- @if(auth()->user()->is_host()) --}}

                        <div>
                            <form action="{{route('exit_conference',['user'=>$user, 'conference'=>$conference])}}" method="post">
                                @csrf
                                @method('delete')

                                <a href="{{route('user_participants',['user'=>$user,'conference'=>$conference])}}" class="float-end">
                                    Back - {{$conference->name}}
                                </a>

                                <div class="row">

                                   



                                    <div class="col-12 mb-3">
                                        <input type="submit" value="{{"Exit ".$conference->name}}" name="submit" class="form-control" >

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
