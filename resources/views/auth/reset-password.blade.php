@extends('homelayout')

@section('course')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <h3 class="text-center mb-4 fw-bold text-success">Reset Password</h3>

                <form method="POST" action="{{ route('password.newpass') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control  rounded-3" 
                               value="{{ $user->email }}"  readonly>
                    </div>
                    




                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>@error('password')
                           <small class="text-danger"> {{ $message }} </small>
                        @enderror
                        <input type="password" name="password" class="form-control @error('password')
                            is-invalid @enderror  rounded-3" value="{{ old('password') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password')
                            is-invalid @enderror rounded-3" value="{{ old('password') }}">
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 fw-semibold rounded-3">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
