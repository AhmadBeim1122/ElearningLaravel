<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Login</title>

    <!-- Boostrap CSS -->
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

     <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- Google Font -->
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">

       <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">
</head>
<body>
    <!--Start Top Navbar -->
    <nav class="navbar navbar-dark fixed-top p-0 shadow" style="background-color: #225470;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('login') }}">E-Learning  <small class="text-white">Admin Login</small></a>

    </nav>
    <!--End Top Navbar -->




<div class="login-container">
  <div class="login-box">
    <h4>Admin Login</h4>

    <!-- Form Start -->
    <form method="post" action="{{ route('adlogin') }}">
      @csrf
      <div class="form-group">
        <i class="fas fa-envelope"></i>
        <label for="email" class="pl-2 font-weight-bold">Email:</label><small class="text-danger">
                @error('email')
                {{ $message }}
                @enderror
            </small>
        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" id="email" autocomplete="off">
      </div>

      <div class="form-group">
        <i class="fas fa-key"></i>
        <label for="password" class="pl-2 font-weight-bold">Password:</label><small class="text-danger">
                @error('password')
                {{ $message }}
                @enderror
            </small>
        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password" autocomplete="new-password">
      </div>


      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Login</button>
        <button type="reset" class="btn btn-secondary ml-2">Cancel</button>
      </div>
    </form>
    <!-- Form End -->

  </div>
</div>


              <!-- Jquery and boostrap Javascript -->
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Fontawesome JS -->
     <script type="text/javascript" src="{{ asset('js/all.min.js') }}"></script>

     <!-- Admin Ajax Call Javascript -->
      {{-- <script type="text/javascript" src="{{ asset('js/new/adminajaxrequest.js') }}"></script> --}}

      <!-- Custom Javascript -->
       {{-- <script src="{{ asset('js/new/custom.js') }}"></script> --}}

</body>
</html>