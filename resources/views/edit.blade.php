@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="p-5">
                        <form action="{{route('profile.update')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}"
                                       required>
                                @error('name')
                                <br>
                                <span class="" role="alert">
                                        <p class="text-danger">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="{{$user->email}}" readonly>
                            </div>

                            <br><br>
                            <button type="submit" class="btn btn-primary btn-block">Update Information</button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Change password</div>
                    <div class="p-5">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{$errors->first()}}
                            </div>
                        @endif
                        <form action="{{route('profile.updatePassword')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="old-password">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="old-password"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" name="password" class="form-control" id="new-password"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       id="confirm-password" required>
                            </div>

                            <br><br>
                            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
