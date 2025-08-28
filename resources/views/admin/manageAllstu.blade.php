@extends('admin.adminlayout')


@section('content')
<div class="col-sm-10 mt-4">
    <!-- table -->
     <p class="bg-dark text-white p-2">
        List of Enrolled Student
     </p>
     <table class="table">
        <thead>
            <tr>
                <th scope="col">Student Sr.</th>
                <th scope="col">Name</th>
                <th scope="col">Course Name</th>
                <th scope="col">Quiz Result(True,False)</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @if (count($enroll) <= 0)
            <h3 class="mt-2 bg-dark text-white p-2">No Student Can Be Enrolled in this course.</h3>
        @else
            @php
                $i=1;
                $true =0;
                $false =0;

            @endphp
            @foreach ($enroll as $en)
                
            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $en->user->name }}</td>
                <td>{{ $en->course->course_name }}</td>

                @foreach ($quizresult as $qz)
                    @if ($qz->student_id == $en->user_id)
                        @if ($qz->quiz_result == 1)
                            @php $true++; @endphp
                        @else
                            @php $false++; @endphp
                        @endif
                    @endif
                @endforeach

                <td>True = {{ $true }}, and False = {{ $false }}</td>
                    
                <td>
                
                <form action="{{ route('enrollAll.delete',$en->user_id) }}" method="POST" class="d-inline"> 
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="{{ $en->course->id }}" name="course_id">
                    <button
                    type="submit"
                    class="btn btn-secondary"
                    onclick="return confirm('Are you sure you want to delete this Enrollment?')">
                    <i class="far fa-trash-alt"></i>  
                </button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif    
             </tbody>
     </table>
          <div class="mt-3 mb-3 d-flex justify-content-center">
            {{ $enroll->links() }}
        </div>
</div>


@endsection




<!-- 🟢 Alert placed before the main content starts -->
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

