@extends('user.Userlayout')

@section('content')
<div class="container-fluid mt-1">
    <!-- Create Button -->
    <div class="mb-2">
        <a href="{{ route('InsCourse.index') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create Lesson
        </a>
    </div>

    <p class="bg-dark text-white p-2">
        Course ID: {{ session('id') }} ,Lessons for {{ session('name') }}
    </p>

    @if(isset($lessons) && count($lessons) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Lesson ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Video Link</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <th scope="row">{{ $lesson->id }}</th>
                        <td>{{ $lesson->lesson_name }}</td>
                        <td>{{ $lesson->lesson_link }}</td>
                        <td>
                            <a href="{{ route('lesson.insedit', $lesson->id) }}" class="btn btn-info mr-3">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('lesson.destroy',$lesson->id) }}" method="POST" class="d-inline"> 
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="role" value="teacher">
                                <button type="submit" class="btn btn-secondary"
                                onclick="return confirm('Are you sure you want to delete this course?')">
                                    <i class="far fa-trash-alt"></i>  
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach    
            </tbody>
        </table>
    @else
        <h3 class="mt-4 bg-dark text-white p-2">No lessons found for this course.</h3>
    @endif
</div>
@endsection




<!-- 🟢 Alert placed before the main content starts -->
{{-- @section('alert') --}}
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


{{-- @endsection --}}