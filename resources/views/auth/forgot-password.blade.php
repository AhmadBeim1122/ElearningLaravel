@extends('homelayout')

@section('course')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5 border-primary">
                <h3 class="text-center mb-4 fw-bold text-primary">Forgot Password</h3>
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>@error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" placeholder="Enter your email" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold">
                        Send Reset Link
                    </button>
                </form>

                @if (session('status'))
                    <div class="alert alert-success mt-3 text-center rounded-3">
                        {{ session('status') }}
                    </div>

                @elseif (session('error'))
                    <div class="alert alert-danger mt-3 text-center rounded-3">
                        {{ session('error') }}
                    </div>   
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
