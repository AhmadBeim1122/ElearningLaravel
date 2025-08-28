@extends('homelayout')


@section('style')

<title>Course • {{ $course->course_name }}</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/course.css') }}">

@endsection


@section('banner')

<!-- Banner -->
<header class="banner">
  <img src="{{ asset('image/bannerpic.jpeg') }}" alt="Course Banner">
  <div class="banner-gradient"></div>
</header>

@endsection


@section('goals')

<!-- Main -->
<main class="py-5">
    <div class="container container-narrow">
      <div class="row g-4">
        <!-- Left column -->
        <div class="col-lg-8">
          
          <!-- Title & meta -->
          <div class="mb-4">
            <h1 class="display-5 fw-bold">{{ $course->course_name }}</h1>
            <div class="d-flex align-items-center gap-3 flex-wrap">
              <span class="badge-topic">{{ $cat_name }}</span>
              <span class="muted small"><i class="bi bi-clock me-1"></i> {{ $course->course_duration }}</span>
              <span class="muted small"><i class="bi bi-people me-1"></i> {{ $counts }} students</span>
              <span class="muted small"><i class="bi bi-translate me-1"></i> {{ $course->course_language }}</span>
            </div>
          </div>
          
          <!-- Category / Level / Language -->
          <div class="row g-3 mb-4">
            <div class="col-6 col-md-4">
              <div class="section-card p-3 h-100">
                <div class="text-uppercase small muted">Category</div>
                <div class="fw-semibold">{{ $cat_name }}</div>
              </div>
            </div>
            <div class="col-6 col-md-4">
              <div class="section-card p-3 h-100">
                <div class="text-uppercase small muted">Level</div>
                <div class="fw-semibold">{{ $course->course_level }}</div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="section-card p-3 h-100">
                <div class="text-uppercase small muted">Language</div>
                <div class="fw-semibold">{{ $course->course_language }}</div>
              </div>
            </div>
          </div>
          
          <!-- Overview -->
          <section class="section-card p-4 p-md-4 mb-4">
            <h2 class="section-title">Overview</h2>
            <div class="section-body">
              <p>{{ $course->course_desc }}</p>
            </div>
          </section>

          <!-- What you will learn -->
          <section class="section-card p-4 p-md-4 mb-4">
            <h2 class="section-title">What you will learn</h2>
            <ul class="what-list list-unstyled mb-0">
              <li><i class="bi bi-check2-circle"></i>Understand how HTML works and its role in web development</li>
              <li><i class="bi bi-check2-circle"></i>Create and structure a basic HTML webpage from scratch</li>
              <li><i class="bi bi-check2-circle"></i>Use essential HTML tags for headings, text, links, images, and more</li>
              <li><i class="bi bi-check2-circle"></i>Build forms with inputs, labels, select boxes and validation basics</li>
              <li><i class="bi bi-check2-circle"></i>Lay a solid foundation for learning CSS &amp; JavaScript</li>
            </ul>
          </section>

          <!-- Curriculum (sample) -->
          <section class="section-card p-4 p-md-4 mb-4">
            <h2 class="section-title">Curriculum</h2>
            <div class="accordion" id="curriculum">
              <div class="accordion-item">
                
                <h2 class="accordion-header" id="h1">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c1" aria-expanded="true">Getting Started</button>
                </h2>

                <div id="c1" class="accordion-collapse collapse show" data-bs-parent="#curriculum">
                  <div class="accordion-body">
                    <ul class="list-unstyled mb-0">
                      @php
                        $i = 0;
                      @endphp
                      @foreach ($course->lesson as $cs)
                        <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                          <!-- Lesson Number Badge -->
                          <span class="d-flex align-items-center">
                            <span class="badge rounded-circle bg-primary me-2" style="width:28px; height:28px; display:flex; align-items:center; justify-content:center;">
                              {{ ++$i }}
                            </span>
                            <span class="fw-semibold">{{ $cs->lesson_name }}</span>
                          </span>

                          <!-- Quiz Info -->
                          <span class="text-muted small"><i class="bi bi-question-circle me-1"></i> 1 Quiz</span>
                        </li>
                      @endforeach
                    </ul>

                  </div>
                </div>

              </div>
              
            </div>
          </section>

          <!-- Instructor (sample) -->
          <section class="section-card p-4 p-md-4 mb-4">
            <h2 class="section-title">Instructor</h2>
            <div class="d-flex align-items-center gap-3">
              <img src="{{ asset("upload/Users/profilePhoto/".$course->user->profile_image) }}" alt="Instructor" class="rounded-circle shadow-soft" width="64" height="64">
              <div>
                <div class="fw-semibold">{{ $course->user->name }}</div>
                <div class="muted small">{{ $course->user->qualification }}</div>
              </div>
            </div>
          </section>

        </div>

        <!-- Right column (sidebar) -->
        <aside class="col-lg-4">
          <div class="section-card p-3 p-md-4 sticky-lg-top">
            <img class="thumb mb-3" src="{{ asset("upload/courses/image/".$course->course_img) }}" alt="Course Thumbnail">

            {{-- <div class="d-flex align-items-end gap-3 mb-2">
              <div class="price-hero">$50</div>
              <div class="price-old">$100</div>
            </div> --}}
            
            @if (Auth::check() && Auth::user()->role == 'teacher')
            
            <div class="d-flex align-items-end gap-3 mb-2">
              <h4 class="price-old text-secondary">Only Student can Enroll</h4>
            </div>

            @else
            <div class="d-flex align-items-end gap-3 mb-2">
              <div class="price-old">Total Lesson {{ $i }}</div>
            </div>
            
            <button class="btn btn-enroll w-100 mb-3 bg-info text-white" id="enrollBtn">
              <i class="bi bi-bag-check me-2"></i>Enroll Now
            </button>
            <div class="small text-center text-muted mb-3">Video Lectures Support</div>
            
            <div id="messageshow"></div>
            @endif


            <div class="include-item">
              <i class="bi bi-infinity"></i> Full lifetime access
            </div>
            <div class="include-item">
              <i class="bi bi-phone"></i> Access on mobile and TV
            </div>
            <div class="include-item">
              <i class="bi bi-card-checklist"></i> Submit Daily Quizzes
            </div>
            <div class="include-item">
              <i class="bi bi-cloud-arrow-down"></i> Downloadable resources
            </div>
          </div>
        </aside>
      </div>
    </div>
  </main>


  @endsection



  
  

@section('scripts')
<script>
$(document).ready(function(){

    // Laravel to JS login status bhejna
    let isLoggedIn = @json(Auth::check());  
    let userid = isLoggedIn ? @json(Auth::id()) : null;  
    let courseid = @json($course->id);

    console.log(userid,courseid);

    // Enroll button
    $('#enrollBtn').on('click', function(e){
      console.log('button clicked');
        e.preventDefault();

        // user login nahi Now to redirect
        if(!isLoggedIn){
            window.location.href = "{{ route('users.create') }}";  
            return;
        }

        // if login is coplete then button animation run
        let $btn = $(this);
        $btn.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...'
        );

        // AJAX request 
        $.ajax({
            url: "{{ route('enroll.course') }}", // route ka naam 
            type: "POST",
            data: {
                userid: userid,
                courseid: courseid,
                _token: "{{ csrf_token() }}"
            },
            
            success: function(response){
            if(response.status === 'success'){
                    $("#messageshow").html(`
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            ${response.message}
                        </div>
                        <a href="/user/mycourses/${userid}" class="btn btn-outline-primary w-100 mt-2">
                            <i class="bi bi-eye me-2"></i> View Course
                        </a>`);

                    setTimeout(function(){
                        $btn.removeClass('btn-enroll bg-info')
                            .addClass('btn-success text-white')
                            .prop('disabled', true)
                            .html('<i class="bi bi-check2-circle me-2"></i> Enrolled');
                    }, 800);

                } else if(response.status === 'error') {
                    $("#messageshow").html(`
                        <div class="alert alert-danger">${response.message}</div>`);
                }
            }


        });
    });



    // Sticky sidebar toggle
    function toggleSticky(){
        if(window.matchMedia('(max-width: 991.98px)').matches){
            $('.sticky-lg-top').removeClass('sticky-lg-top');
        } else {
            $('aside.col-lg-4 > .section-card').addClass('sticky-lg-top');
        }
    }
    toggleSticky();
    $(window).on('resize', toggleSticky);

});
</script>
@endsection




@section('category')
    @foreach ($categ as $ct)
        <a href="{{ route('category',$ct->Category_Name ) }}" class="text-dark">{{ $ct->Category_Name }}</a><br>
    @endforeach
@endsection