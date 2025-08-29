@extends('admin.adminlayout')


@section('content')

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Lesson</h3>

    <form action="{{ route('lesson.store') }}" method="post" enctype="multipart/form-data"
    class="lessonForm" id="lessonForm">
        @csrf
        <div class="form-group">
            <label for="course_id">Course ID : </label>
            <input type="text" class="form-control" id="course_id" name="course_id" value="{{ $id }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="{{ $name }}" readonly>
        </div>
        


        <div class="form-group">
            <label for="lesson_name">Lesson Names</label><small class="text-danger">
                @error('lesson_name')
                {{ $message }}
                @enderror
            </small>
            <input class="form-control @error('lesson_name') is-invalid @enderror" name="lesson_name" id="lesson_name" value="{{ old('lesson_name') }}">
        </div>
        

        <div class="form-group">
            <label for="lesson_desc">Lesson Description</label><small class="text-muted">(Max 500 characters)</small><small class="text-danger">
                @error('lesson_desc')
                {{ $message }}
                @enderror
            </small>
            <textarea class="form-control @error('lesson_desc') is-invalid @enderror" name="lesson_desc" id="lesson_desc"  rows="7">{{ old('lesson_desc') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="lesson_link">Lesson Video : </label><small class="text-danger">
                @error('lesson_link')
                {{ $message }}
                @enderror
            </small>
            <input type="file" class="form-control @error('lesson_link') is-invalid @enderror" id="lesson_link" name="lesson_link" value="{{ old('lesson_link') }}">
        </div>
       
        
         <hr>
        <h4 class="mt-4 text-center">Add Quiz</h4>

        <div class="form-group">
            <label for="question">Question : </label>
            @error('question')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" id="question" value="{{ old('question') }}">
        </div>


        <div class="form-group">
            <label for="option_1">Option 1 : </label>
            @error('option_1')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_1') is-invalid @enderror" name="option_1" id="option_1" value="{{ old('option_1') }}">
        </div>

        <div class="form-group">
            <label for="option_2">Option 2 : </label>
            @error('option_2')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_2') is-invalid @enderror" name="option_2" id="option_2" value="{{ old('option_2') }}">
        </div>
 
        <div class="form-group">
            <label for="option_3">Option 3 : </label>
            @error('option_3')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_3') is-invalid @enderror" name="option_3" id="option_3" value="{{ old('option_3') }}">
        </div>

        <div class="form-group">
            <label for="option_4">Option 4 : </label>
            @error('option_4')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <input type="text" class="form-control @error('option_4') is-invalid @enderror" name="option_4" id="option_4" value="{{ old('option_4') }}">
        </div>

        <div class="form-group">
            <label for="correct_answer">Correct Answer</label>
            @error('correct_answer')
                <small class="text-danger">{{ $message }} </small>
            @enderror
            <select class="form-control @error('correct_answer') is-invalid @enderror" name="correct_answer" id="correct_answer">
                <option value="" selected disabled>Select Correct Answer</option>
                <option value="option_1">Option 1</option>
                <option value="option_2">Option 2</option>
                <option value="option_3">Option 3</option>
                <option value="option_4">Option 4</option>
            </select>
        </div>

        <input type="hidden" name="role" value="admin">
        
               <!-- Progress Bar -->
{{-- <div class="progress mt-3" style="height: 25px;">
  <div class="progress-bar progress-bar-striped progress-bar-animated" 
       role="progressbar" style="width: 0%">0%</div>
</div> --}}

<!-- Success Message -->
{{-- <div id="message" class="mt-3"></div> --}}
        
        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="lessonSubmitBtn">Submit</button>
            <a href="{{ route('lesson.index') }}" class="btn btn-primary">Close</a>
        </div>
    </form>
</div>


    
@endsection



{{-- @section('scripts')

<script>
document.getElementById('lessonForm').addEventListener('submit', function(e){
    e.preventDefault();

    let form = document.getElementById('lessonForm');
    let formData = new FormData(form);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);

    // Laravel CSRF Token
    xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

    // Progress event
    xhr.upload.addEventListener("progress", function(e) {
        if (e.lengthComputable) {
            let percent = Math.round((e.loaded / e.total) * 100);
            let progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = percent + "%";
            progressBar.textContent = percent + "%";
        }
    });

    // On complete
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('message').innerHTML =
                `<div class="alert alert-success">Lesson uploaded successfully!</div>`;
            
            // reset form
            form.reset();
            document.querySelector('.progress-bar').style.width = "0%";
            document.querySelector('.progress-bar').textContent = "0%";
        } else {
            document.getElementById('message').innerHTML =
                `<div class="alert alert-danger">Upload failed!</div>`;
        }
    };

    xhr.send(formData);
});
</script>



@endsection --}}