@extends('admin.adminlayout')

@section('content')

<div class="col-sm-9 mt-5">
    <!-- table -->
     <p class="bg-dark text-white p-2">
        List of @if($role == 'student') Students @elseif($role == 'teacher') Instructor @endif
     </p>

     <table class="table">
        <thead>
            <tr>
                <th scope="col">@if($role == 'student') Student @elseif($role == 'teacher') Instructor @endif ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                    
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                     <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info mr-3">
                        <i class="fas fa-pen"></i>
                    </a>
                    
                    <form action="{{ route('user.destroy',$user->id) }}" method="POST" class="d-inline"> 
                        @csrf
                        @method('DELETE')
                        <button
                        type="submit"
                        class="btn btn-secondary"
                        name="delete"
                        value="Delete">
                        <i class="far fa-trash-alt"></i>  
                    </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        
     </table>
     <div class="mt-3 mb-3 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>



<div>
    <a href="{{ route('adduser') }}" class="btn btn-danger box">
        <i class="fas fa-plus fa-2x"></i>
    </a>
</div>
@endsection










@section('alert')
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
            }, 4000);
        </script>

    @endif
@endsection


