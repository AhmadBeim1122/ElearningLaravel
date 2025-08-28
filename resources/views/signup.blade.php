@extends('homelayout')

@section('style')
   <!-- FilePond core CSS -->
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />

<!-- FilePond image plugins CSS -->
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.min.css" rel="stylesheet" />

<link href="https://unpkg.com/doka/doka.min.css" rel="stylesheet"/>


@endsection

@section('banner')
<!-- Start Course Page banner -->
<div class="container-fluid bg-dark">
    <div class="row" style="background-color: #225470">
        <img src="" alt="" style="height: 300px; width: 100%; object-fit: fill; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">
    </div>
</div>
<!-- End Course Page banner -->
@endsection


@section('course')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Create Your Account</h4>
                </div>

                <div class="card-body bg-light">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Full Name <span class="text-danger">*</span></label><small class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        </div>


                        <div class="form-group mb-3">
                            <label for="email">Email Address <span class="text-danger">*</span></label><small class="text-danger">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off" value="{{ old('email') }}">
                        </div>



                        <div class="form-group mb-3">
                            <label for="password">Password <span class="text-danger">*</span></label><small class="text-danger">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" value="{{ old('password') }}">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label><small class="text-danger">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" autocomplete="off" value="{{ old('password') }}">
                        </div>



                        <div class="form-group mb-3">
                            <label for="phone">Phone Number <span class="text-danger">*</span></label><small class="text-danger">
                                @error('phone')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label><small class="text-danger">
                                @error('address')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="qualification">Qualification</label><small class="text-danger">
                                @error('qualification')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="text" name="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Register as <span class="text-danger">*</span></label><small class="text-danger">
                                @error('role')
                                {{ $message }}
                                @enderror
                            </small>
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                <option selected disabled>-- Select Role --</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="bio">Bio Information</label><small class="text-muted">(Max 500 characters)</small><small class="text-danger">
                                @error('bio')
                                {{ $message }}
                                @enderror
                            </small>
                            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dob">Date of Birth</label><small class="text-danger">
                                @error('dob')
                                {{ $message }}
                                @enderror
                            </small>
                            <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
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
                                <input type="file" 
                                class="filepond"
                                name="profile_image"
                                accept="image/png, image/jpeg, image/gif, image/jpg"/>
                                   
                            
                        </div>

                        <button type="submit" class="btn btn-success w-100">Sign Up</button>
                        {{-- <a href="{{ route('google.login') }}" class="btn btn-danger">
                            <i class="fab fa-google"></i> Login with Google
                        </a> --}}


                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection





@section('category')
    @foreach ($categ as $ct)
        <a href="{{ route('category',$ct->Category_Name ) }}" class="text-dark">{{ $ct->Category_Name }}</a><br>
    @endforeach
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
