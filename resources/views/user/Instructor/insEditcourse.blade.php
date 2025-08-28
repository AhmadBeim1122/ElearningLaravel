@extends('user.Userlayout')

@section('content')
<div class="col-sm-9 mt-2 justify-content-center mx-5 jumbotron">
    <h3 class="text-center">Edit Course Details</h3>

    <form action="{{ route('course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


         <div class="form-group">
            <label>Instructor ID</label>
            <input type="text" class="form-control" name="ins_id" value="{{ Auth::user()->id }}" readonly>
        </div>    

        <input type="hidden" name="role" value="teacher">

         <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" class="form-control" id="course_id" name="course_id" value="{{ $course->id }}" readonly>
        </div>


        <div class="form-group">
            <label for="course_name">Course Name</label><small class="text-danger">
                @error('course_name')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="course_name" name="course_name" value="{{ old('course_name',$course->course_name) }}">
        </div>
        

        
        
        <div class="form-group">
            <label for="course_category">Course Category</label><small class="text-danger">
                @error('course_category')
                {{ $message }}
                @enderror
            </small>
            <select name="course_category" id="" class="form-control">
                <option value="" selected disabled>{{ old('course_category',$cat_name) }}</option>

                @foreach ($categories as $ct)
                <option value="{{ $ct->id }}">{{ $ct->Category_Name }}</option>
                    
                @endforeach
            </select>
        </div>
        
        
        
        <div class="form-group">
            <label for="course_level">Course Level</label><small class="text-danger">
                @error('course_level')
                {{ $message }}
                @enderror
            </small>
            <select name="course_level" id="" class="form-control">
                <option value="" selected disabled>{{ old('course_level',$course->course_level) }}</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
            </select>
        </div>
        
        


        
        <div class="form-group">
            <label for="course_language">Course Language</label><small class="text-danger">
                @error('course_language')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_language') is-invalid @enderror" id="course_language" name="course_language" value="{{ old('course_language',$course->course_language) }}">
        </div>

        
        <div class="form-group">
            <label for="course_description">Course Description</label><small class="text-muted">(Max 500 characters)</small><small class="text-danger">
                @error('course_description')
                {{ $message }}
                @enderror
            </small>
            <textarea class="form-control @error('course_description') is-invalid @enderror" rows="7" name="course_description" id="course_description">{{ old('course_description',$course->course_desc) }}</textarea>
        </div>
{{-- 
        <div class="form-group">
            <label for="course_description">Course Description</label><small class="text-danger">
                @error('course_description')
                {{ $message }}
                @enderror
            </small>
            <textarea class="form-control @error('course_description') is-invalid @enderror" name="course_description" id="course_description">{{ old('course_description',$course->course_desc) }}</textarea>
        </div>
         --}}
        
        <div class="form-group">
            <label for="course_author">Author</label><small class="text-danger">
                @error('course_author')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_author') is-invalid @enderror" id="course_author" name="course_author" value="{{ old('course_author',$course->course_author) }}">
        </div>

        
        <div class="form-group">
            <label for="course_duration">Course Duration</label><small class="text-danger">
                @error('course_duration')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_duration') is-invalid @enderror" id="course_duration" name="course_duration" value="{{ old('course_duration',$course->course_duration) }}">
        </div>
        

        {{-- <div class="form-group">
            <label for="course_original_price">Course Original Price</label><small class="text-danger">
                @error('course_original_price')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_original_price') is-invalid @enderror" id="course_original_price" name="course_original_price" value="{{ old('course_original_price',$course->course_org_price) }}">
        </div>
        

        <div class="form-group">
            <label for="course_price">Course Selling Price</label><small class="text-danger">
                @error('course_price')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_price') is-invalid @enderror" id="course_price" name="course_price" value="{{ old('course_price',$course->course_price) }}">
        </div> --}}
        

        <div class="form-group">
            <label for="course_image">Course Image</label><small class="text-danger">
                @error('course_image')
                {{ $message }}
                @enderror
            </small><br>

            <img id="output" class="img-fluid img-thumbnail" src="{{ asset('upload/courses/image/' . $course->course_img) }}" alt="Photo Update"><br><br>

            <input type="file" class="form-control-file @error('course_image') is-invalid @enderror" id="course_image" name="course_image"
            onchange="document.querySelector('#output').src = window.URL.createObjectURL(this.files[0])"
            >
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-danger" >Submit</button>
            <a href="{{ route('course.index') }}" class="btn btn-primary">Close</a>
        </div>

    </form>
</div>

@endsection