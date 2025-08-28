@extends('admin.adminlayout')

@section('content')

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Lesson Details</h3>


    <form action="{{ route('lesson.update',$lesson->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="lesson_id">Lesson ID</label>
            <input type="text" class="form-control" id="lesson_id" name="lesson_id" value="{{ $lesson->id }}" readonly>
        </div>

        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" class="form-control" id="course_id" name="course_id" value="{{ $lesson->course_id }}" readonly>
        </div>


        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" onkeypress="Isinputnumber(event)" value="{{ $course_name }}" readonly>
        </div>


        <div class="form-group">
            <label for="lesson_name">Lesson Name</label><small class="text-danger">
                @error('lesson_name')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('lesson_name') is-invalid @enderror" id="lesson_name" name="lesson_name" value="{{ old('lesson_name',$lesson->lesson_name) }}">
        </div>
        
        
        <div class="form-group">
            <label for="lesson_desc">Lesson Description</label><small class="text-muted">(Max 500 characters)</small><small class="text-danger">
                @error('lesson_desc')
                {{ $message }}
                @enderror
            </small>
            <textarea class="form-control @error('lesson_desc') is-invalid @enderror" name="lesson_desc" rows="7" id="lesson_desc">{{ old('lesson_desc',$lesson->lesson_description) }}</textarea>
        </div>

        

        <div class="form-group">
            <label for="lesson_link">Lesson Video</label><small class="text-danger">
                @error('lesson_link')
                {{ $message }}
                @enderror
            </small>
            <br><br> 
            <div class="embedded-responsive embedded-responsive-16by9">
                
                {{-- <iframe class="embedded-responsive-item" id="output" src="{{ asset('upload/courses/lessonVideo/' . $lesson->lesson_link)}}" ></iframe>
                 --}}
                
                <video id="output" class="embed-responsive-item" controls style="border-radius: 8px; width: 90%; height: auto; max-width: 720px; display: block; margin: auto;">
                    <source src="{{ asset('upload/courses/lessonVideo/' . $lesson->lesson_link) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                 <br><br>

                <input type="file" class="form-control-file @error('lesson_link') is-invalid @enderror" id="lesson_link" name="lesson_link" onchange="document.querySelector('#output').src = window.URL.createObjectURL(this.files[0])">
            </div>    
        </div>



        
         
         <hr>
        <h4 class="mt-4 text-center">Add Quiz</h4>

        <div class="form-group">
            <label for="question">Question : </label>
            @error('question')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" id="question" value="{{ old('question',$quiz->question) }}">
        </div>


        <div class="form-group">
            <label for="option_1">Option 1 : </label>
            @error('option_1')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_1') is-invalid @enderror" name="option_1" id="option_1" value="{{ old('option_1',$quiz->option_1) }}">
        </div>

        <div class="form-group">
            <label for="option_2">Option 2 : </label>
            @error('option_2')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_2') is-invalid @enderror" name="option_2" id="option_2" value="{{ old('option_2',$quiz->option_2) }}">
        </div>
 
        <div class="form-group">
            <label for="option_3">Option 3 : </label>
            @error('option_3')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_3') is-invalid @enderror" name="option_3" id="option_3" value="{{ old('option_3',$quiz->option_3) }}">
        </div>

        <div class="form-group">
            <label for="option_4">Option 4 : </label>
            @error('option_4')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_4') is-invalid @enderror" name="option_4" id="option_4" value="{{ old('option_4',$quiz->option_4) }}">
        </div>

        <div class="form-group">
            <label for="correct_answer">Correct Answer</label>
            @error('correct_answer')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <select class="form-control @error('correct_answer') is-invalid @enderror" name="correct_answer" id="correct_answer">
                <option value="" selected disabled>{{ old('correct_answer',$quiz->correct_answer) }}</option>
                <option value="option_1">Option 1</option>
                <option value="option_2">Option 2</option>
                <option value="option_3">Option 3</option>
                <option value="option_4">Option 4</option>
            </select>
        </div>

        <input type="hidden" name="role" value="admin">
        

        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="requpdate" id="requpdate">Update</button>
            <a href="{{ route('lesson.index') }}" class="btn btn-primary">Close</a>
        </div>

    </form>
</div>

@endsection