@extends('user.Userlayout')

@section('content')

<div class="container mt-4 pt-1 ">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-1">

            <div class="text-center mb-3">
                <h2 class="font-weight-bold text-secondary">All Courses</h2>
                <hr class="w-25 mx-auto">
            </div>

            @foreach ($enroll as $en)
                
            
            {{-- Course Box --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $en->course->course_name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        
                        {{-- Course Image --}}
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <img src="{{ asset('upload/courses/image/'.$en->course->course_img ) }}" class="img-fluid rounded shadow-sm" alt="course image">
                        </div>
                        
                        {{-- Course Info --}}
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Description:</strong> {{ Str::limit($en->course->course_desc, 70) }}</p>
                            <p class="mb-1"><strong>Duration:</strong> {{ $en->course->course_duration }}</p>
                            <p class="mb-1"><strong>Instructor:</strong> {{ $en->course->course_author }}</p>
                            <p class="mb-1 d-inline"><strong>Course Level:</strong>
                                <span class="font-weight-bold text-success ml-2">{{ $en->course->course_level }}</span>
                            </p>
                        </div>
                        
                        {{-- Watch Button --}}
                        <div class="col-md-3 text-md-right text-center mt-3 mt-md-0">
                            <a href="{{ route('watchcourse',$en->course->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-play-circle mr-1"></i> Watch Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach

            {{-- You can duplicate the above block for more courses --}}
        </div>
    </div>
</div>

@endsection
