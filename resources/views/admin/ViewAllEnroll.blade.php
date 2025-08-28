@extends('admin.adminlayout')

@section('content')
<div class="container mt-4 pt-4">
    
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
                        <th scope="col">Duration</th>
                        <th scope="col" class="text-center">Total Student Enroll</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr style="cursor: pointer;" 
                            onclick="window.location='{{ route('manage.AllstuEnroll',$course->id) }}'">

                            
                            <th scope="row">{{ $course->id }}</th>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->course_author }}</td>
                            <td>{{ $course->course_duration }}</td>
                            <td class="text-center">
                              {{ $course->enroll_count }}
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



