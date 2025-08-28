@extends('admin.adminlayout')


@section('content')
<div class="col-sm-9 mt-5">
    <!-- table -->
     <p class="bg-dark text-white p-2 d-flex align-items-center justify-content-between">
        <span>List of Feedback</span>
        <span>
            <a href="{{ route('userfeedback') }}" class="btn btn-sm btn-outline-light me-2">Student</a>
            <a href="{{ route('Insfeedback') }}" class="btn btn-sm btn-warning">Instructor</a>
        </span>
    </p>

     <table class="table">
        <thead>
            <tr>
                <th scope="col">Feedback ID</th>
                <th scope="col">Content</th>
                <th scope="col">User ID</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedback as $fd)
                
            <tr>
                <th scope="row">{{ $fd->id }}</th>
                <td>{{ $fd->f_content }}</td>
                <td>{{ $fd->user_id }}</td>
                
                <td>
                    <form action="{{ route('fbdestroy',$fd->id) }}" method="POST" class="d-inline"> 
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
</div>


{{-- 
<div>
    <a href="#" class="btn btn-danger box">
        <i class="fas fa-plus fa-2x"></i>
    </a>
</div> --}}
    
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

