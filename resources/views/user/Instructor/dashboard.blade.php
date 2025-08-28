@extends('user.Userlayout')

@section('content')


 
<div class="col-sm-10">
                <div class="row mx-2 text-center">
                    <!-- 1st Data Box -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">
                            Total Course 
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $coursecount }}
                            </h4>
                            <a href="{{ route('InsCourse.show',Auth::user()->id) }}" class="btn text-white">View</a>
                        </div>
                        </div>
                    </div>
                    <!-- 2nd Data Box -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">
                            Total Feedback
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $feedback }}
                            </h4>
                            <a href="{{ route('feedback.show',Auth::user()->id) }}" class="btn text-white">View</a>
                        </div>
                        </div>
                    </div>
                    <!-- 3rd Data Box -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header">
                            Total Enrollment
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $total }}
                            </h4>
                            <a href="{{ route('view.enrollments',Auth::user()->id) }}" class="btn text-white">View</a>
                        </div>
                        </div>
                    </div>
                    <!-- End Boxes -->
                    
                </div>

                <!-- Details -->
                {{-- <div class="mx-5 mt-5 text-center">
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
                </div> --}}



                <!-- End Details -->
            </div>
        </div> <!-- Div Close from header of row -->
      </div> <!-- Div Close from header of container-fluid -->
    <!-- Side Bar -->

    
@endsection