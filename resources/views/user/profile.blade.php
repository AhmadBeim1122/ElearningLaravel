@extends('user.Userlayout')

@section('content')

<div class="container mt-2">
    {{-- Welcome Section --}}
    <div class="row">
        <div class="col-md-12 bg-gradient-primary text-white p-4 rounded shadow-sm" style="background: linear-gradient(135deg, #17a2b8, #138496);">
            <h2 class="mb-0">
                Welcome 
                @if ($users->role == 'teacher') 
                    Sir 
                @endif 
                {{ $users->name }}
            </h2>
        </div>
    </div>

    <div class="row mt-4">
        {{-- General Information --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-id-card mr-2"></i>General Information</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover mb-0">
                        <tbody>
                            <tr>
                                <th scope="row">ID</th>
                                <td>{{ $users->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ $users->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone</th>
                                <td>{{ $users->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td>{{ $users->address }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Qualification</th>
                                <td>{{ $users->qualification }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Date of Birth</th>
                                <td>{{ $users->dob }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Gender</th>
                                <td>{{ $users->gender }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- About User --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0"><i class="fas fa-user mr-2"></i>About User</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted" style="white-space: pre-line;">
                        {{ $users->bio ?? 'No bio available.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<!-- 🟢 Alert placed before the main content starts -->
{{-- @section('alert') --}}
     @if(session('success'))
        <div id="toastMessage" class="toast-message">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let toast = document.getElementById('toastMessage');
                if (toast) {
                    toast.classList.add('hide');
                }
            }, 2000);
        </script>
    @endif
{{-- @endsection --}}