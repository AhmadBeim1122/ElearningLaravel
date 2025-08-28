<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Dashboard</title>

    <!-- Boostrap CSS -->
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

     <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- Google Font -->
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">

       <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">


        @yield('style')
</head>
<body>
    <!--Start Top Navbar -->
    <nav class="navbar navbar-dark  p-0 shadow" style="background-color: #225470;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('dashboard') }}">E-Learning <small class="text-white">Admin Area</small></a>

    </nav>
    <!--End Top Navbar -->

    <!-- Side Bar -->
     <div class="container-fluid mb-5" style="margin-top: 0px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admins.index') }}" class="nav-link {{ request()->routeIs('admins.index') ? 'active' : '' }}"><i class="fas fa-user-shield"></i> All Admin</a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}"><i class="fas fa-tags"></i> Categories</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('course.index') }}" class="nav-link {{ request()->routeIs('course.index') ? 'active' : '' }}"><i class="fas fa-book"></i> Courses</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('lesson.index') }}" class="nav-link {{ request()->routeIs('lesson.index') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Lessons</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('adduser') }}" class="nav-link {{ request()->routeIs('adduser') ? 'active' : '' }}"> <i class="fas fa-user-plus"></i> Add User</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('instructor') }}" class="nav-link {{ request()->routeIs('instructor') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Teacher</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('student') }}" class="nav-link {{ request()->routeIs('student') ? 'active' : '' }}"><i class="fas fa-user-graduate"></i> Student</a>
                        </li>
                        
                        
                        
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i> Quiz Report</a>
                        </li> --}}
                        
                        <li class="nav-item">
                            <a href="{{ route('All.Enroll') }}" class="nav-link {{ request()->routeIs('All.Enroll') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Enrollments</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('userfeedback') }}" class="nav-link {{ request()->routeIs('userfeedback') ? 'active' : '' }}"><i class="fas fa-comments"></i> FeedBack</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                 <!-- Vertical Divider -->
                {{-- <div class="vertical-divider d-none d-md-block"></div> --}}
            </nav>
            <!-- End Side Bar -->



            
            @yield('content')
            
            
            
            

            
    <!-- Bootstrap Bundle with Popper (Bootstrap 5 ke liye ye enough hai) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
            
    <!-- Jquery and boostrap Javascript -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Fontawesome JS -->
    <script type="text/javascript" src="{{ asset('js/all.min.js') }}"></script>
    
    <!-- Admin Ajax Call Javascript -->
    <script type="text/javascript" src="{{ asset('js/new/adminajaxrequest.js') }}"></script>
    
    
    


    
    @yield('alert')

    @yield('scripts')
</body>
</html>