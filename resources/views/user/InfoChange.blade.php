@extends('user.Userlayout')

@section('content')

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-10 bg-light shadow rounded p-4">

            <div class="bg-secondary text-white p-3 mb-4 rounded">
                <h2 class="mb-0">Change Your Information</h2>
            </div>

            <form action="{{ route('users.update',$users->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="userId">User ID</label>
                    <input type="text" class="form-control" name="userId" value="{{ $users->id }}" readonly>
                </div>


                <div class="form-group mb-3">
                    <label for="userEmail">User Email</label>
                    <input type="text" class="form-control" name="userEmail" value="{{ $users->email }}" readonly>
                </div>


                <div class="form-group mb-3">
                    <label for="user_name">User Name</label>
                        @error('user_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name',$users->name) }}">
                </div>


                <div class="form-group mb-3">
                    <label for="user_bio">Bio Information</label><small class="text-muted">(Max 500 characters)</small>
                        @error('user_bio')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    <textarea type="text" class="form-control  @error('user_bio') is-invalid @enderror" name="user_bio" rows="7">{{ old('user_bio',$users->bio) }}</textarea>
                </div>
                 
                
                <div class="form-group mb-3">
                    <label for="user_qualification">Qualification</label>
                        @error('user_qualification')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    <input type="text" class="form-control  @error('user_qualification') is-invalid @enderror" name="user_qualification" value="{{ old('user_qualification',$users->qualification) }}">
                </div>


                <div class="form-group mb-3">
                    <label for="password">New Password</label>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="New Password" name="password" value="{{ old('password') }}">
                </div>


                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                </div>



                <div class="form-group mb-3">
                    <label for="User_image">Change Profile Image</label>
                        @error('User_image')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    <br>
                    
                    <img id="output" class="img-fluid img-thumbnail" src="{{ asset('upload/Users/profilePhoto/'.$users->profile_image) }}" alt="Photo Update"><br><br>

                    <input type="file" class="form-control-file" id="User_image" name="User_image" value="{{ old('User_image') }}"
                    onchange="document.querySelector('#output').src = window.URL.createObjectURL(this.files[0])"
                    >
                </div>

                <button type="submit" class="btn btn-primary" name="updateStuNameBtn">Update</button>
            </form>

        </div>
    </div>
</div>

@endsection
