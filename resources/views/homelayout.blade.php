
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Elearning</title>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Boostrap CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('css/owl.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.theme.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset("css/testyslider.css") }}">

    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}" />

 <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    


    @yield('style')

    

      <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>


@yield('style')




    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    {{-- Fontawwesome CSS --}}
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    
</head>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<body>


  


    {{-- Start navigation --}}
    <nav class="navbar navbar-expand-sm navbar-dark  pl-5 fixed-top">
    <div class="container-fluid">
        <div class="hsize">
            <a class="navbar-brand" href="{{ route('home') }}">E-LEARNING</a>
        </div>
        <span class="navbar-text">Learn and Implement</span>
    
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse pl-5" id="navbarNavAltMarkup">
            <ul class="navbar-nav custom-nav">
                <li class="nav-item custom-nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item custom-nav-item"><a class="nav-link" href="{{ route('course') }}">Courses</a></li>

                {{-- <li class="nav-item custom-nav-item"><a class="nav-link" href="{{ route('paystatus') }}">Payment Status</a></li> --}}
                
                {{-- <li class="nav-item custom-nav-item"><a class="nav-link" href="#">Contact Us</a></li> --}}
                {{-- <li class="nav-item custom-nav-item"><a class="nav-link" href="#">Feedback</a></li> --}}
                

                @if (Auth::check())
                    
                  <li class="nav-item custom-nav-item"><a class="nav-link" href="{{ route('users.show',Auth::user()->id) }}">My profile</a></li>
                  <li class="nav-item custom-nav-item" id="logoutbtn"><a class="nav-link" href="{{ route('user.logout') }}">Logout</a></li>
                
                @elseif (Auth::guest())
                  <li class="nav-item custom-nav-item" style="cursor: pointer;" data-toggle="modal" data-target="#StuLogin"><a class="nav-link" >Login</a></li>
                  <li class="nav-item custom-nav-item"><a class="nav-link" href="{{ route('users.create') }}">Sign up</a></li>
                
                @endif
            </ul>
        </div>
    </div>
    </nav>

    {{-- End Navigation --}}


    @yield('banner')

    @yield('goals')

    @yield('course')



    
    {{-- @yield('contact-us') --}}

    @yield('Ins_feedback')

    @yield('feedback')



{{-- Start About Section --}}
    <div class="container-fluid p-4" style="background-color: #E9ECEF;">
        <div class="container" style="background-color: #E9ECEF;">
            <div class="row text-center">
                <div class="col-sm">
                    <h5>About Us</h5>
                    <p>E-Learning is an online platform where knowledge meets opportunity.  
                      We connect passionate instructors with eager learners, making quality education  
                      accessible anytime, anywhere.</p>
                </div>
                <div class="col-sm">
                    <h5>Categories</h5>
                    @yield('category')
                </div>

                <div class="col-sm">
                  <h5>Quick Links</h5>
                  <ul class="list-unstyled">
                      <li><a href="{{ route('home') }}" class=" text-dark">Home</a></li>
                      <li><a href="{{ route('course') }}" class=" text-dark">Courses</a></li>
                      <li data-toggle="modal" data-target="#StuLogin" class=" text-dark" style="cursor: pointer;">Login</li>
                      <li><a href="{{ route('users.create') }}" class=" text-dark">Sign Up</a></li>
                  </ul>
              </div>

                <div class="col-sm">
                    <h5>Contact Us</h5>
                    <p>E-Learning Pvt Ltd <br>
                      Online Knowledge Hub <br>
                      Support: support@elearning.com <br>
                      Ph. +92 328 718877</p>
                </div>
            </div>
        </div>

    </div>
{{-- End About Section --}}



{{-- Start Footer --}}
{{-- <footer class="container-fluid bg-dark text-center p-2">
        <small class="text-white">&copy; Your Academy || Designed By E-Learning</small>
    </footer> --}}
{{-- End Footer --}}


{{-- @if(Auth::check())
    <h3>Welcome, {{ Auth::user()->name }}</h3>
    <p>Email: {{ Auth::user()->email }}</p>
    <p>Role: {{ Auth::user()->role }}</p>
@endif --}}



<!-- Start Login -->
    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="StuLogin" tabindex="-1" aria-labelledby="StuLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="StuLoginLabel">Student Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Start Form Code -->
          <form id="stulogform" autocomplete="off">
            <div class="form-group">
                <i class="fas fa-envelope"></i><label for="email" class="pl-2 font-weight-bold">Email</label>
                <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">
              </div>

              <div class="form-group">
                <i class="fas fa-key"></i><label for="password" class="pl-2 font-weight-bold">Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">
              </div>
            
          </form>
          <!-- End Form Code -->

          <!-- Forgot Password Link -->
          <div class="text-right">
            <a href="{{ route('password.request') }}">Forgot Password?</a>
          </div>


        </div>
        <div class="modal-footer">
          <small id="statusloginmsg"></small>
            <button type="button" class="btn btn-primary" id="stuloginbtn">Login</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
         
        </div>
      </div>
    </div>
  </div>
<!-- End Login -->













{{-- Teacher Feedback Testimonial --}}

<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 2000, // 2 seconds
      disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      1024: {
        slidesPerView: 3
      }
    }
  });
</script>



<!-- Jquery and boostrap JavaScript -->
    <!-- <script src="../js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>



    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>

    <script src="{{ asset('js/owl.min.js') }}"></script>
    {{-- <script src="{{ asset("js/testyslider.js") }}"></script> --}}
    <script src="{{ asset('js/swiper.js') }}"></script>

  
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    

    
     <!-- Bootstrap JavaScript (Must be before closing </body>) -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <!-- Fontawesome -->
    <script src="js/all.min.js"></script>
    
    
    <!-- Include Owl Carousel CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
   
   
   {{-- Send Values to ajaxrequest --}}
   <script>
    var loginUrl = "{{ route('user.login') }}";
    var csrfToken = "{{ csrf_token() }}";
  </script>



    {{-- custom js --}}
    <script type="text/JavaScript" src="{{ asset('js/new/ajaxrequest.js') }}"></script>



  {{-- <script>
    const navEl = document.querySelector('.navbar');

    window.addEventListener('scroll' , ()=>{
      if(window.scrollY >= 800){
      navEl.classList.add('navbar-scroll');
      } else if(window.scrollY < 800){
        navEl.classList.remove('navbar-scroll');
      }
    })
  </script> --}}

   <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Owl Carousel Init -->
    <script>
    $(document).ready(function(){
        $("#testimonial-slider").owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            dots: true,
            nav: false
        });
    });
    </script>


  @yield('scripts')
</body>
</html>