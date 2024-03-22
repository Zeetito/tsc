@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                    
                @if(App\Models\Conference::active_conference() == false)
                    @if(auth()->user()->is_host())
                        <a href="{{route('create_conference')}}" class="float-end btn btn-info">
                            New Conference
                        </a>
                        <a href="{{route('transfer_host_confirm')}}" class="float-end btn btn-secondary">
                            Transfer Host
                        </a>
                    @endif
                        
                @else
                        <a href="{{route('show_conference',['conference'=>App\Models\Conference::active_conference()])}}" class="float-end btn btn-info">
                            {{App\Models\Conference::active_conference()->name}}
                        </a>
                @endif

                        
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
