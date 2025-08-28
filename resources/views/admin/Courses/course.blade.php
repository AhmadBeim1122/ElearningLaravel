@extends('admin.adminlayout')


@section('content')
<div class="col-sm-9 mt-5">
    <!-- table -->
     <p class="bg-dark text-white p-2">
        List of Courses
     </p>
     <table class="table">
        <thead>
            <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                
            <tr>
                <th scope="row">{{ $course->id }}</th>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->course_author }}</td>
                <td>
                    <a href="{{ route('course.show', $course->id) }}" class="btn btn-info mr-3">
                        <i class="fas fa-pen"></i>
                    </a>
                
                <form action="{{ route('course.destroy', $course->id) }}" method="POST" class="d-inline"> 
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="role" value="admin">
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
            {{ $courses->links() }}
        </div>
</div>



<div>
    <a href="{{ route('course.create') }}" class="btn btn-danger box">
        <i class="fas fa-plus fa-2x"></i>
    </a>
</div>

@endsection






