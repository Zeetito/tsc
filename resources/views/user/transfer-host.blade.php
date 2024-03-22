@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Host Transfer') }}
                
                    <a class="btn btn-info mr-2 mb-2 float-end" href="{{route('home')}}" >
                        Go Back
                    </a>


                        <div>
                            <form action="{{route('transfer_host')}}" method="post">
                                @csrf
                                {{-- @method('delete') --}}



                                    <div class="col-12 mb-3">
                                        <select class="form-control" name="user_id" id="" required>
                                            <option value="">Select Campus</option>
                                            @foreach(App\Models\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>

                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="submit" value="Transfer Host" name="submit" class="btn-info form-control" >

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
