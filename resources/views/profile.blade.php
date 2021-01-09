@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Profile</div>
                        <div class=" p-5">
                            <div id="app">
                                <div class="">
                                    <photo src="{{$user->profile_image}}" id="{{$user->id}}"></photo>
                                </div>
                            </div>


                            <form>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{$user->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{$user->email}}" readonly>
                                </div>
                                <br><br>
                                <a href="{{route('profile.edit')}}" class="btn btn-primary btn-block">Edit</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
