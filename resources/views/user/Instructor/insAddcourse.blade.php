@extends('user.Userlayout')


@section('content')
<div class="col-sm-9 mt-2 justify-content-center mx-5 jumbotron">
    <h3 class="text-center">Add New Course</h3>

    <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Instructor ID</label> 
            <input type="text" class="form-control" name="ins_id" value="{{ Auth::user()->id }}" readonly>
        </div>    

        <input type="hidden" name="role" value="teacher">


        <div class="form-group">
            <label for="course_name">Course Name</label><small class="text-danger">
                @error('course_name')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="course_name" name="course_name" value="{{ old('course_name') }}">
        </div>
        

        
        <div class="form-group">
            <label for="course_category">Course Category</label><small class="text-danger">
                @error('course_category')
                {{ $message }}
                @enderror
            </small>
            <select name="course_category" id="" class="form-control">
                <option selected disabled>Select Course Category</option>
                @foreach ($category as $ct)
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
                <option selected disabled>Select Course Level</option>
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
            <input type="text" class="form-control @error('course_language') is-invalid @enderror" id="course_language" name="course_language" value="{{ old('course_language') }}">
        </div>



         <div class="form-group">
            <label for="course_description">Course Description</label><small class="text-muted">(Max 500 characters)</small>
                @error('course_description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            
            <textarea class="form-control @error('course_description') is-invalid @enderror" rows="7" name="course_description" id="course_description">{{ old('course_description') }}</textarea>
            
        </div> 
        
{{-- 
        <div class="form-group">
            <label for="course_description">Course Description</label><small class="text-danger">
                @error('course_description')
                {{ $message }}
                @enderror
            </small>
            <textarea class="form-control @error('course_description') is-invalid @enderror" name="course_description" id="course_description">{{ old('course_description') }}</textarea>
        </div>
        
         --}}
        <div class="form-group">
            <label for="course_author">Author</label><small class="text-danger">
                @error('course_author')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_author') is-invalid @enderror" id="course_author" name="course_author" value="{{ old('course_author') }}">
        </div>

        
        <div class="form-group">
            <label for="course_duration">Course Duration</label><small class="text-danger">
                @error('course_duration')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_duration') is-invalid @enderror" id="course_duration" name="course_duration" value="{{ old('course_duration') }}">
        </div>
        

        {{-- <div class="form-group">
            <label for="course_original_price">Course Original Price</label><small class="text-danger">
                @error('course_original_price')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_original_price') is-invalid @enderror" id="course_original_price" name="course_original_price" value="{{ old('course_original_price') }}">
        </div> --}}
        

        {{-- <div class="form-group">
            <label for="course_price">Course Selling Price</label><small class="text-danger">
                @error('course_price')
                {{ $message }}
                @enderror
            </small>
            <input type="text" class="form-control @error('course_price') is-invalid @enderror" id="course_price" name="course_price" value="{{ old('course_price') }}">
        </div>
         --}}

        <div class="form-group">
            <label for="course_image">Course Image</label><small class="text-danger">
                @error('course_image')
                {{ $message }}
                @enderror
            </small>
            <input type="file" class="form-control-file @error('course_image') is-invalid @enderror" id="course_image" name="course_image" value="{{ old('course_image') }}">
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-danger" >Submit</button>
            <a href="{{ route('InsCourse.show',Auth::user()->id) }}" class="btn btn-primary">Close</a>
        </div>

    </form>
</div>

@endsection