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
                            <div class="d-flex justify-content-center mb-3">
                                <img src="https://i.pinimg.com/originals/f5/1d/08/f51d08be05919290355ac004cdd5c2d6.png"
                                     class="img-thumbnail rounded mx-auto d-block"
                                     width="100" height="100"
                                     alt="...">
                            </div>
                            <div class="d-flex justify-content-center mb-5">
                                <button class="btn btn-primary">Update Image</button>
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
