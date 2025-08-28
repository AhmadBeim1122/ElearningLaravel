@extends('homelayout')


@section('banner')



        {{-- Video start --}}
    <div class="container-fluid remove-vid-marg">
        <div class="vid-parent">
            <video playsinline autoplay loop muted>
                <source src="video/bg-vid.mp4">
            </video>
            <div class="vid-overlay">

            </div>
        </div>
        <div class="vid-content">
            <h1 class="my-content">Welcome To E-Learning</h1>
            <small class="my-content">Learn and Implement</small><br>
        </div>
    </div>
    {{-- Video end --}}

    {{-- Start Text Banner --}}
    <div class="container-fluid btn-danger txt-banner">
        <div class="row bottom-banner"> 
            <div class="col-sm">
                <h5><i class="fas fa-book-open mr-3"></i>100+ Onilne Courses</h5>
            </div>
            <div class="col-sm">
                <h5><i class="fas fa-users mr-3"></i>Expert Instructor</h5>
            </div>
            <div class="col-sm">
                <h5><i class="fa-solid fa-keyboard mr-3"></i></i>Lifetime Access</h5>
            </div>
            <div class="col-sm">
                <h5><i class="fas fa-rupee-sign mr-3"></i>money Back Gurantee</h5>
            </div>

        </div>

    </div>
    {{-- End Text Banner --}}
    
@endsection



@section('goals')
{{-- 1st Photo --}}
  <section class="story section container">
        <div class="story-container grid">

          <div class="story-data">
            <h2 class="section-title story-section-title">Our Goals</h2>
            <h1 class="story-title">
              Enjoy learning without any pressure
            </h1>

            <p class="story-description">
              Learn make something with real world project that help you increase creativity
            </p>
            <a href="{{ route('course') }}" class="button btn-small">Discover</a>
          </div>
          
          <div class="story-images">
            <img src="{{ asset('image/front1.jpg') }}" alt="" class="story-img" />
            <div class="story-square"></div>
          </div>
        </div>
        </section>



{{-- 2nd Photo --}}
  <section class="story section container">
  <div class="story-container-1 grid">

    <div class="story-data">
      <h2 class="section-title story-section-title">For @if(Auth::check() && Auth::user()->role == 'student') Student @else Instructors @endif </h2>
      <h1 class="story-title">
        Share your knowledge with the world
      </h1>

      <p class="story-description">
        Create and publish your own courses with real-world projects, inspire students, and grow your teaching impact.
      </p>
      @if (Auth::check() && Auth::user()->role == 'teacher')
      <a href="{{ route('InsCourse.show',Auth::user()->id) }}" class="button btn-small">Create Course</a>
      
      @elseif (Auth::check() && Auth::user()->role == 'student')
      <a href="{{ route('mycourses',Auth::user()->id) }}" class="button btn-small">Watch Course</a>
      
      
      @else
      <a href="{{ route('users.create') }}" class="button btn-small">Create Course</a>
      
      @endif

    </div>
    
    <div class="story-images">
      <img src="{{ asset('image/front2.jpeg') }}" alt="Instructor teaching" class="story-img" />
      <div class="story-square"></div>
    </div>
  </div>
</section>

@endsection






@section('course')
<div class="container mt-5">
    <h1 class="text-center">Popular Courses</h1>

    {{-- First Courses --}}
    <div class="row mt-4">
        @foreach ($first as $fs)
            <div class="col-sm-4 mb-4">
                <a href="{{ route('coursedetail', $fs->id) }}" class="btn p-0 m-0 text-left">
                    <div class="card h-100">
                        <img src="{{ asset('upload/courses/image/'.$fs->course_img) }}" 
                             class="card-img-top img-fluid" 
                             alt="Course_photo"
                             style="height: 200px; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $fs->course_name }}</h5>
                            <p class="card-text">
                                {{ Str::limit($fs->course_desc,100) }}
                                <a href="{{ route('coursedetail',$fs->id) }}" class="see-more-link">See more &raquo;</a>
                            </p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline">
                                Author: <span class="font-weight-bolder">{{ $fs->course_author }}</span>
                            </p>
                            <a href="{{ route('coursedetail', $fs->id) }}" class="btn btn-primary text-white font-weight-bolder float-right">Enroll</a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Second Courses --}}
    <div class="row mt-4">
        @foreach ($second as $sc)
            <div class="col-sm-4 mb-4">
                <a href="{{ route('coursedetail', $sc->id) }}" class="btn p-0 m-0 text-left">
                    <div class="card h-100">
                        <img src="{{ asset('upload/courses/image/'.$sc->course_img) }}" 
                             class="card-img-top img-fluid" 
                             alt="Course_photo"
                             style="height: 200px; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $sc->course_name }}</h5>
                            <p class="card-text">
                                {{ Str::limit($sc->course_desc,100) }}
                                <a href="{{ route('coursedetail', $sc->id) }}" class="see-more-link">See more &raquo;</a>
                            </p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline">
                                Author: <span class="font-weight-bolder">{{ $sc->course_author }}</span>
                            </p>
                            <a href="{{ route('coursedetail', $sc->id) }}" class="btn btn-primary text-white font-weight-bolder float-right">Enroll</a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-2 mb-4">
        <a href="{{ route('course') }}" class="btn btn-danger btn-sm">View All Courses</a>
    </div>
</div>
@endsection







@section('contact-us')
        {{-- Start Contact US --}}
    <div class="container mt-4" id="Contact">
        {{-- Start Contact US container --}}

            {{-- Contact Us Heading --}}
            <h2 class="text-center mb-4"><a name="Contactus"></a>Contact US</h2>
            {{-- Start Contact US Row --}}
            <div class="row">
                {{-- Contact US First Column --}}
                <div class="col-md-8">
                    <form action="" method="post">
                        <input type="text" name="name" placeholder="Name" class="form-control" /><br>
                        <input type="text" name="subject" placeholder="Subject" class="form-control" /><br>
                        <input type="email" name="email" placeholder="Email" class="form-control" /><br>
                        <textarea name="message" class="form-control" placeholder="How Can We Help You?" style="height: 170px;"></textarea><br>
                        <input type="submit" name="submit" value="Send" class="btn btn-primary"><br><br>
                    </form>
                </div>

                {{-- Contact US 2nd Column --}}
                <div class="col-md-4 Stripe text-white text-center">
                    <h4>E-Learning</h4>
                    <p>E-Learning,
                        Online learning Platform,<br>
                        E-mail: ahmad@gmail.com <br>
                        Phone: +9232703289 <br>
                        www.elearning.com</p>
                </div>
                {{-- End 2nd Column --}}
            </div>
        {{-- End Contact US container --}}
    </div>
    
    {{-- End Contact US --}}
@endsection


@section('Ins_feedback')

<section style="color: #000; background-color: #f3f2f2;">
  <div class="container py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 col-xl-8 text-center">
        <h3 class="fw-bold mb-4">What Teachers Say About Us</h3>
        <p class="mb-4 pb-2 mb-md-5 pb-md-0">
        Hear directly from instructors who have shared their knowledge on our platform.  
        Their experiences and feedback highlight how teaching here has helped them grow,  
        connect with students, and make an impact worldwide.
        </p>
      </div>
    </div>

    <!-- Swiper Container -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">


        @foreach ($feedback as $Ins_fb)
            @if ($Ins_fb->user->role == 'teacher')
                
            
        <!-- Slide 1 -->
        <div class="swiper-slide">
            <div class="card t-card">
                <div class="card-body py-4 mt-2">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{ asset('upload/Users/profilePhoto/'. $Ins_fb->user->profile_image) }}"
                        class="rounded-circle shadow-1-strong" width="100" height="100" alt="Instructor_photo"
                        style="object-fit: cover;"
                        />
                    </div>
                    <h5 class="font-weight-bold">{{ $Ins_fb->user->name }}</h5>
                    <h6 class="font-weight-bold my-3">{{ $Ins_fb->user->qualification }}</h6>
                    {{-- <ul class="list-unstyled d-flex justify-content-center">
                        <li><i class="fas fa-star fa-sm text-info"></i></li>
                        <li><i class="fas fa-star fa-sm text-info"></i></li>
                        <li><i class="fas fa-star fa-sm text-info"></i></li>
                        <li><i class="fas fa-star fa-sm text-info"></i></li>
                        <li><i class="fas fa-star-half-alt fa-sm text-info"></i></li>
                    </ul> --}}
                    <p class="mb-2">
                        <i class="fas fa-quote-left pe-2"></i> {{ $Ins_fb->f_content }}
                    </p>
                </div>               
            </div>
        </div>
        @endif
        @endforeach

      </div>
    </div>
  </div>
</section>


@endsection


@section('feedback')
        {{-- Start Testimonial --}}
    <div class="container-fluid mt-4" style="background-color: #4B7289;" id="feedback">
        <h1 class="text-center testyheading p-4 text-white"><a name="feedback"></a>Student's Feedback</h1>
        <div class="row">
            <div class="col-md-12">
                <div id="testimonial-slider" class="owl-carousel">
                    @foreach ($feedback as $stu_fb)
                        @if ($stu_fb->user->role == 'student')
                            
                        <div class="testimonial">
                            <p class="description text-white">{{ $stu_fb->f_content }}</p>
                            <div class="pic">
                            <img src="{{ asset('upload/Users/profilePhoto/'. $stu_fb->user->profile_image) }}" alt="Student_photo" class="img-fluid rounded-circle">
                        </div> 
                        <div class="testimonial-prof text-white">
                            <h4>{{ $stu_fb->user->name }}</h4>
                            <small>{{ $stu_fb->user->qualification }}</small>
                        </div>   
                    </div>
                    
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- End Testimonial --}}



    {{-- Start Socail Follow --}}
    <div class="container-fluid bg-danger">

        <div class="row text-white text-center p-1">
            <div class="col-sm">
                <a href="#" class="text-white social-hover"><i class="fab fa-facebook-f"></i> Facebook</a>
            </div>
            
            <div class="col-sm">
                <a href="#" class="text-white social-hover"><i class="fab fa-twitter"></i> Twitter</a>
            </div>
            <div class="col-sm">
             <a href="#" class="text-white social-hover"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            </div>
            <div class="col-sm">
                <a href="#" class="text-white social-hover"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
        
        </div>

    </div>
{{-- End Socail Follow --}}
    
@endsection



@section('category')
    @foreach ($categories as $ct)
        <a href="{{ route('category',$ct->Category_Name ) }}" class="text-dark">{{ $ct->Category_Name }}</a><br>
    @endforeach
@endsection
