@extends('admin.adminlayout')

@section('style')

   <!-- FilePond core CSS -->
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />

<!-- FilePond image plugins CSS -->
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.min.css" rel="stylesheet" />

<link href="https://unpkg.com/doka/doka.min.css" rel="stylesheet"/>

@endsection

@section('content')

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3 class="text-center">Edit @if($user->role == 'student') Student @elseif($user->role == 'teacher') Instructor @endif </h3>

    <form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Full Name <span class="text-danger">*</span></label><small class="text-danger">
                @error('name')
                {{ $message }}
                @enderror
            </small>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}" readonly>
        </div>



        <div class="form-group mb-3">
            <label for="email">Email Address <span class="text-danger">*</span></label><small class="text-danger">
                @error('email')
                {{ $message }}
                @enderror
            </small>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off" value="{{ old('email' ,$user->email) }}" readonly>
        </div>


        <div class="form-group mb-3">
            <label for="phone">Phone Number <span class="text-danger">*</span></label><small class="text-danger">
                @error('phone')
                {{ $message }}
                @enderror
            </small>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$user->phone) }}">
        </div>

        <div class="form-group mb-3">
            <label for="address">Address</label><small class="text-danger">
                @error('address')
                {{ $message }}
                @enderror
            </small>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address',$user->address) }}">
        </div>

        <div class="form-group mb-3">
            <label for="qualification">Qualification</label><small class="text-danger">
                @error('qualification')
                {{ $message }}
                @enderror
            </small>
            <input type="text" name="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification',$user->qualification) }}">
        </div>

        <div class="form-group mb-3">
            <label for="role">Register as <span class="text-danger">*</span></label><small class="text-danger">
                @error('role')
                {{ $message }}
                @enderror
            </small>
            <select name="role" class="form-control @error('role') is-invalid @enderror">
                <option selected disabled>{{ old('role',$user->role) }}</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="bio">Bio Information</label><small class="text-danger">
                @error('bio')
                {{ $message }}
                @enderror
            </small>
            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="2">{{ old('bio',$user->bio) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="dob">Date of Birth</label><small class="text-danger">
                @error('dob')
                {{ $message }}
                @enderror
            </small>
            <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob',$user->dob) }}">
        </div>

        <div class="form-group mb-3">
            <label>Gender</label><small class="text-danger">
                @error('gender')
                {{ $message }}
                @enderror
            </small>
            <div class="d-flex gap-3 mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label pr-4" for="male">Male</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="profile_image">Profile Image</label>
            @error('profile_image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <br>

            <img id="output" class="img-fluid img-thumbnail" src="{{ asset('upload/Users/profilePhoto/' . $user->profile_image) }}" alt="Photo Update"><br><br>

                <input type="file" class="filepond" id="profile_image" name="profile_image">
                    
            
        </div>

        <button type="submit" class="btn btn-success w-100">Sign Up</button>

    </form>
</div>

@endsection



@section('scripts')
    <!-- FilePond core -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <!-- Image Preview plugin -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    <script>
        // Register plugin
        FilePond.registerPlugin(FilePondPluginImagePreview);

        // Apply FilePond on input
        FilePond.create(document.querySelector('.filepond'), {
            allowImagePreview: true,
            instantUpload: false,  // important: file sirf form submit pe jayega
            credits: false,
             storeAsFile: true,
        });
    </script>
@endsection