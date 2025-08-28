@extends('admin.adminlayout')
<!-- 🟢 Alert placed before the main content starts -->
@section('alert')
    @if(session('success'))
        <div id="toastMessage" class="toast-message"> 
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let toast = document.getElementById('toastMessage');
                if (toast) {
                    toast.classList.add('hide');
                }
            }, 4000);
        </script>
    @endif
@endsection




@section('content')


 
<div class="col-sm-9 mt-5">
                <div class="row mx-5 text-center">
                    <!-- 1st Data Box -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">
                            All User
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $user }}
                            </h4>
                            <a href="{{ route('instructor') }}" class="btn text-white">Teacher</a>
                            <a href="{{ route('student') }}" class="btn text-white">Student</a>
                        </div>
                        </div>
                    </div>
                    <!-- 2nd Data Box -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">
                            Total Courses
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $course }}
                            </h4>
                            <a href="{{ route('course.index') }}" class="btn text-white">View</a>
                        </div>
                        </div>
                    </div>
                    <!-- 3rd Data Box -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                        <div class="card-header">
                            Enrollments
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $enrolls }}
                            </h4>
                            <a href="#" class="btn text-white">View</a>
                        </div>
                        </div>
                    </div>
                    <!-- End Boxes -->
                    
                </div>

                {{-- <!-- Details -->
                <div class="mx-5 mt-5 text-center">
                    <!-- Table -->
                    <p class="bg-dark text-white p-2">
                        Courses Ordered
                    </p>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Ordered ID</th>
                                <th scope="col">Course ID</th>
                                <th scope="col">Student Email</th>
                                <th scope="col">Ordered Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">22</th>
                                <td>100</td>
                                <td>ibtasamasgher@gmail.com</td>
                                <td>20/10/2020</td>
                                <td>2000</td>
                                <td><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Details --> --}}



            </div>
        </div> <!-- Div Close from header of row -->
      </div> <!-- Div Close from header of container-fluid -->
    <!-- Side Bar -->

    
@endsection