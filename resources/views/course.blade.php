@extends('homelayout')

@section('style')

<link rel="stylesheet" href="{{ asset('css/course.css') }}">
    <!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection


@section('banner')
<header class="banner">
    <img src="{{ asset('image/bannerpic.jpeg') }}" alt="Course Banner" style="height: 300px">
    <div class="banner-gradient"></div>
</header>
@endsection

@section('course')

<!-- Start Courses Page -->
<div class="container-fluid mt-3">
    <div class="row">
        
        <!-- Left Sidebar -->
        <div class="col-md-3 mb-4 mt-5">
            <!-- Search Bar -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Search</h5>
                    <form action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control mt-1" name="search" placeholder="Search courses...">
                            <button class="btn btn-dark" type="submit">
                                <i class="bi bi-search ml-1 pt-3"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($categories as $ct)
                        <li class="list-group-item"><a href="{{ route('category',$ct->Category_Name ) }}" class="text-decoration-none">{{ $ct->Category_Name }}</a></li>
                            
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Side Courses -->
        <div class="col-md-9">
            <h1 class="text-center fw-bold text-dark mb-4 border-bottom pb-2">
                {{ $category ?? 'All Courses' }}
                </h1>
            <div class="row g-4">
                @foreach ($courses as $course)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('coursedetail', $course->id) }}" class="btn w-100 p-0 m-0 text-start">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="{{ asset("upload/courses/image/".$course->course_img) }}" class="card-img-top img-fluid"
                                alt="Course_photo"
                                style="height: 200px; width: 100%; object-fit: cover;"/>
                                <div class="card-body">
                                    <h5 class="card-title fw-semibold">{{ $course->course_name }}</h5>
                                    <p class="card-text small text-muted">
                                        {{ Str::limit($course->course_desc,100) }}
                                        <a href="#" class=" text-primary small">See more &raquo;</a>
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-clock me-1"></i> <strong>{{ $course->course_duration }}</strong></span>
                                    <a href="{{ route('coursedetail', $course->id) }}" class="btn btn-primary btn-sm">Enroll</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-3 mb-3 d-flex justify-content-center">
                {{ $courses->links() }}
            </div>
        </div>

    </div>
</div>
<!-- End Courses Page -->

@endsection



@section('category')
    @foreach ($categ as $ct)
        <a href="{{ route('category',$ct->Category_Name ) }}" class="text-dark">{{ $ct->Category_Name }}</a><br>
    @endforeach
@endsection

