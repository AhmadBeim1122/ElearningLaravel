<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Student Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/studstyle.css') }}">

    {{-- filepond css --}}
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">




    
    
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (Bundle me Popper included hai) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




     
</head>
<body>

    <!--Start Top Navbar -->
    <nav class="navbar navbar-dark  p-0 shadow" style="background-color: #225470;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0 pt-2 pb-2 pl-4 fs-3" href="#"><b>E-Learning</b> <small class="text-white">User Area</small></a>

        <!-- Home Button -->
    <div class="ms-auto me-3">
        <a href="{{ route('home') }}" class="btn btn-light btn-sm">
            <i class="fas fa-home"></i> Home
        </a>
    </div>
    </nav>
    <!--End Top Navbar -->

  <div class="container-fluid">
    <div class="row">
        
        <!-- Sidebar -->
        <nav class="col-md-2 col-sm-3 bg-light sidebar py-5 d-print-none">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item mb-3 propic">
                        <img src="{{ asset('upload/Users/profilePhoto/'.Auth::user()->profile_image) }}" alt="User_image" class="rounded-circle img-circle">
                    </li>
                    

                    
                    <li class="nav-item">
                        <a href="{{ route('users.show',Auth::user()->id) }}" class="nav-link {{ request()->routeIs('users.show') ? 'active' : '' }}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                   
                   
                    @if (Auth::user()->role == 'teacher')

                    <li class="nav-item">
                        <a href="{{ route('Ins.dashboard',Auth::user()->id) }}" class="nav-link {{ request()->routeIs('Ins.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                        
                    @endif

                    @if (Auth::user()->role == 'student')
                        {{-- For Student Role --}}
                        <li class="nav-item">
                            <a href="{{ route('mycourses',Auth::user()->id) }}" class="nav-link {{ request()->routeIs('mycourses') ? 'active' : '' }}">
                                <i class="fab fa-accessible-icon"></i> My Courses
                            </a>
                        </li>
                    @else
                    {{-- For Teacher Role --}}
                    <li class="nav-item">
                        <a href="{{ route('InsCourse.show',Auth::user()->id) }}" class="nav-link {{ request()->routeIs('InsCourse.show') ? 'active' : '' }}">
                            <i class="fab fa-accessible-icon"></i> Create Courses
                        </a>
                    </li>
                    

                    <li class="nav-item">
                        <a href="{{ route('view.enrollments',Auth::user()->id) }}" class="nav-link {{ request()->routeIs('view.enrollments') ? 'active' : '' }}">
                            <i class="fab fa-accessible-icon"></i> Enrollments
                        </a>
                    </li>

                    @endif
                    
                    


                    <li class="nav-item">
                        <a href="{{ route('feedback.show',Auth::user()->id) }}" class="nav-link {{ request()->routeIs('feedback.show') ? 'active' : '' }}">
                            <i class="fas fa-comment-dots"></i> Feedback
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('users.edit',Auth::user()->id) }}" class="nav-link {{ request()->routeIs('users.edit') ? 'active' : '' }}">
                            <i class="fas fa-key"></i> Change Information
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.logout') }}" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 col-sm-9 ml-sm-auto px-4 py-3">
            @yield('content')
        </main>

    </div>
</div>
          
            
            



    @yield('alert')




       <!-- JS Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>

    <!-- Optional Custom JS -->
    <script src="{{ asset('js/new/custom.js') }}"></script>

    <!-- FilePond scripts -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>


    @yield('scripts')

</body>
</html>
