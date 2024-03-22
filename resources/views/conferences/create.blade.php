@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Initiate New Conference') }}
                
                    @if(auth()->user()->is_host())

                        <div>
                            <form action="{{route('store_conference')}}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <strong>Name Of Conference</strong>
                                        <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="name of conference" required>

                                    </div>

                                    <div class="col-12 mb-3">
                                        <strong>Start Date</strong>
                                        <input type="date" value="{{old('start_date')}}" name="start_date" class="form-control" required>

                                    </div>

                                    <div class="col-12 mb-3">
                                        <strong>End Date</strong>
                                        <input type="date" value="{{old('end_date')}}" name="end_date" class="form-control" required>

                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="submit" value="Create" name="submit" class="btn-info form-control" >

                                    </div>

                                </div>
                            </form>
                        </div>

                    @endif

                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
