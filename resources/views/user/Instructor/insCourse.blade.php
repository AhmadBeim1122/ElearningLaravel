@extends('user.Userlayout')

@section('content')
<div class="container-fluid">
    <!-- Create Button -->
    <div class="mb-1">
        <a href="{{ route('InsCourse.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create Course
        </a>
    </div>

    <!-- Courses List -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">List of Courses</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table table-bordered">
                    <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Author</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr style="cursor: pointer;" 
                            onclick="window.location='{{ route('InsCourse.edit',$course->id) }}'">

                            
                            <th scope="row">{{ $course->id }}</th>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->course_author }}</td>
                            <td class="text-center">
                                <!-- Edit -->
                                <a href="{{ route('course.insedit', $course->id) }}" 
                                class="btn btn-info mr-3"
                                onclick="event.stopPropagation();">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('course.destroy', $course->id) }}" 
                                    method="POST" 
                                    class="d-inline"
                                    onclick="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="role" value="teacher">
                                    <input type="hidden" name="ins_id" value="{{ auth()->id() }}">
                                    <button type="submit" 
                                            class="btn btn-secondary"
                                            onclick="return confirm('Are you sure you want to delete this course?')">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No courses found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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