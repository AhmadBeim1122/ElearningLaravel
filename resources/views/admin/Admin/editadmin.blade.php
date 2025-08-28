@extends('admin.adminlayout')

@section('content')

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Edit Admin</h3>

    <form action="{{ route('admins.update',$admin->id) }}" method="post" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ad_id">Name</label><small class="text-danger">
                @error('ad_id')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('ad_id') is-invalid @enderror" id="ad_id" name="ad_id" value="{{ old('',$admin->id) }}" readonly>
        </div>


        <div class="form-group">
            <label for="ad_name">Name</label><small class="text-danger">
                @error('ad_name')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('ad_name') is-invalid @enderror" id="ad_name" name="ad_name" value="{{ old('ad_name',$admin->name) }}">
        </div>
        


        <div class="form-group">
            <label for="ad_email">Email</label><small class="text-danger">
                @error('ad_email')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('ad_email') is-invalid @enderror" name="ad_email" id="ad_email" autocomplete="off" value="{{ old('ad_email',$admin->email) }}">
        </div>


        
        <div class="form-group">
            <label for="password">Create New Password</label><small class="text-danger">
                @error('password')
                {{ $message }}
                @enderror
            </small>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password" value="{{ old('password') }}">
        </div>
        
        <div class="form-group">
            <label for="password">Password Confirmation</label><small class="text-danger">
                @error('password')
                    
                        {{ $message }}
                    
                @enderror
            </small>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="newadSubmitBtn" id="newadSubmitBtn">Submit</button>
            <a href="{{ route('admins.index') }}" class="btn btn-primary">Close</a>
        </div>
    </form>
</div>

@endsection