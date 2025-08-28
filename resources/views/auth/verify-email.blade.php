
@extends('homelayout')

@section('course')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <h3 class="text-center mb-3 fw-bold text-primary">Verify Your Email</h3>
                <p class="text-center text-muted mb-4">
                    We have sent a verification link to your email. <br> 
                    Please check your inbox to complete verification.
                </p>

                @if (session('message'))
                    <div class="alert alert-success text-center rounded-3">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 fw-semibold py-2">
                        Resend Verification Email
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
