@extends('admin.adminlayout')


@section('content')

<div class="col-sm-9 mt-4 mx-3">
    <form action="{{ route('lesson.index') }}" class="mt-3 form-inline d-print-none">
        <div class="form-group mr-3">
            <label for="checkid"><b>Enter Course ID: </b></label>
            <input type="text" class="form-control ml-3" id="checkid" name="checkid">

        </div>
        <button type="submit" class="btn btn-danger">Search</button>
    </form>

@if(isset($lessons) && count($lessons) > 0)
     <h3 class="mt-4 bg-dark text-white p-2">Course ID: {{ $courseId }} , 
        Course Name: {{ $course_name }}</h3>


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
                            <a href="{{ route('lesson.edit', $lesson->id) }}" class="btn btn-info mr-3">
                                <i class="fas fa-pen"></i>
                            </a>
                        
                        <form action="{{ route('lesson.destroy',$lesson->id) }}" method="POST" class="d-inline"> 
                            @csrf
                            @method('DELETE')

                            <input type="hidden" name="role" value="admin">
                            <input type="hidden" name="course_id" value="{{ $courseId }}">
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
            {{ $lessons->links() }}
        </div>
     @elseif(isset($courseId))
        <h3 class="mt-4 bg-dark text-white p-2">No lessons found for Course ID : {{ $courseId }} </h3>
        
    </div>
@endif

    @if (isset($courseId))
        
    <div>
        <form action="{{ route('lesson.create') }}" method="get">
            <input type="hidden" name="id" value="{{ $courseId }}">
            <input type="hidden" name="name" value="{{ $course_name }}">
            <button type="submit" class="btn btn-danger box">
                <i class="fas fa-plus fa-2x"></i>
            </button>
        </form>
    </div>
    @endif
@endsection



