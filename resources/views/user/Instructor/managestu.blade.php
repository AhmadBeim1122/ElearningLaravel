@extends('user.Userlayout')


@section('content')
<div class="col-sm-10 mt-2 ml-1">
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
            <h3 class="mt-4 bg-dark text-white p-2">No Student Can Be Enrolled for this course.</h3>
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
                
                <form action="{{ route('enroll.delete',$en->user_id) }}" method="POST" class="d-inline"> 
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="{{ $en->course->id }}" name="course_id">
                    <button
                    type="submit"
                    class="btn btn-secondary"
                    onclick="return confirm('Are you sure you want to delete this course?')">
                    <i class="far fa-trash-alt"></i>  
                </button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif    
             </tbody>
     </table>
</div>


@endsection




<!-- 🟢 Alert placed before the main content starts -->
@section('alert')
@if(session('success'))
    <div id="toastMessage" class="toast-message">
        {{ session('success') }}
    </div>

    <script>
        // Auto hide toast after 2 seconds
        setTimeout(function() {
            let toast = document.getElementById('toastMessage');
            if (toast) {
                toast.classList.add('hide');
            }
        }, 2000);

        // Detect Back button page load (bfcache) and refresh
        window.addEventListener("pageshow", function(event) {
            if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
                window.location.reload();
            }
        });
    </script>
@endif


@endsection